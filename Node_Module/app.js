const express = require('express');
const session = require('express-session');
const bodyParser = require('body-parser');
const mysql = require('mysql');
const sha256 = require('sha256');
const multer = require('multer');
const path = require('path');
const tc = require('./text-color');

const app = express();

const host = 'localhost';
const port = 3000;
const db = 'transient';

let date = new Date().toISOString().split('T')[0];
let pendingReq;
let accepted;
let book;
let success;

const con = mysql.createConnection({
  host: '192.168.1.9',
  user: 'root1',
  password: '',
  database: db
});
con.connect(err => {
  if (err) {
    console.log(tc.text('error', 'database connection error!'));
    throw err;
  } else {
    console.log(tc.text('suc', `Connected to ${db} database!`));
  }
});


const storage = multer.diskStorage({
  destination: 'views/static/uploads/',
  filename: (req, file, cb) => {
    cb(null, file.fieldname + '-' + Date.now() + path.extname(file.originalname));
  }
});

const upload = multer({
  storage: storage,
  fileFilter: (req, file, cb) => {
    const fileTypes = /jpeg|jpg|png/;
    const extname = fileTypes.test(path.extname(file.originalname).toLowerCase());
    const mimetype = fileTypes.test(file.mimetype);
    if (mimetype && extname) {
      return cb(null, true);
    } else {
      cb('error');
    }
  }
}).single('dormImg');

app.set('view engine', 'ejs');

app.use('/static', express.static(__dirname + '/views/static'));
app.use(bodyParser.urlencoded({
  extended: false
}));
app.use(bodyParser.json());
app.use(session({
  secret: 'webtek'
}));

app.get('/', (req, res) => {
  if (req.session.username) {
    res.redirect('/dashboard', {
      user: req.session.username.replace(/\b\w/g, l => l.toUpperCase()),
      profilePic: req.session.profPic
    }, 302);
  } else {
    res.render('index', {
      message: ''
    });
  }
});

app.post('/dashboard', (req, res) => {
  username = req.body.username;
  password = req.body.password;

  con.query(`SELECT * FROM provider WHERE prov_username=? AND prov_pswd=?`, [username, password], (err, results) => {

    if (results.length) {

      if (results[0].rep_status == 'Active') {
        
        req.session.username = username;
        req.session.password = password;
        req.session.provId = results[0].prov_id;
        req.session.profPic = results[0].prov_pic;
        console.log(tc.text('info', `${results[0].prov_username} logged in!`));

        res.redirect(302, '/dashboard');
      } else if (results[0].rep_status == 'Banned') {
        res.render('index', {
          message: 'You\'re account has been disabled. Please contact admin at angege@gmail.com'
        });
      } else {
        res.render('index', {
          message: 'You\'re account is still under review.'
        });
      }
    } else {
      res.render('index', {
        message: 'Wrong username or password!'
      });
    }
  });
});

app.get('/dashboard', (req, res) => {

  con.query(`SELECT unit_address, client_id, client_fname, client_lname, client_phoneno, client_email, res_date, checkout_date, res_id FROM units Natural JOIN reservation Natural Join client where prov_id=? and res_status="Pending"`, [req.session.provId], (err, row) => {
    pendingReq = row;
  });
  con.query(`SELECT unit_address, client_id, client_fname, client_lname, client_phoneno, client_email, res_date, checkout_date, res_id FROM units Natural JOIN reservation Natural Join client where prov_id=? and res_status="Accepted"`, [req.session.provId], (err, row) => {
    accepted = row;
  });
  con.query(`SELECT unit_address, client_id, client_fname, client_lname, client_phoneno, client_email, res_date, checkout_date, res_id FROM units Natural JOIN reservation Natural Join client where prov_id=? and res_status="Booked"`, [req.session.provId], (err, row) => {
    book = row;

    if (req.session.username) {
      res.render('dashboard', {
        user: req.session.username.replace(/\b\w/g, l => l.toUpperCase()),
        profilePic: req.session.profPic,
        pendingReq: pendingReq,
        accepted: accepted,
        book: book
      });
    } else {
      res.render('index', {
        message: 'You are not logged in!'
      });
    }
  });
});

app.get('/logout', (req, res) => {
  let username = req.session.username;
  req.session.destroy(err => {
    if (err) {
      res.negotiate(err);
    } else {
      res.redirect('/', {
        message: 'test'
      }, 302);
      console.log(tc.text('warning', `${username} logged out!`));
    }
  });
});

app.get('/listings', (req, res) => {
  if (req.session.username) {
    con.query(`select units.trans_id, prov_id, condo_name, unit_description, unit_capacity, unit_address, no_of_beds, price_per_night, vacancy, post_status, upic_id, picture from units left join unit_pics on units.trans_id = unit_pics.trans_id group by trans_id having prov_id = ?`, [req.session.provId], (err, results) => {
      res.render('listings', {
        user: req.session.username.replace(/\b\w/g, l => l.toUpperCase()),
        profilePic: req.session.profPic,
        card: results
      });
    });
  } else {
    res.render('index', {
      message: 'You are not logged in!'
    });
  }
});

app.get('/new-entry', (req, res) => {
  if (req.session.username) {
    res.render('newEntry', {
      user: req.session.username.replace(/\b\w/g, l => l.toUpperCase()),
      profilePic: req.session.profPic
    });
  } else {
    res.render('index', {
      message: 'You are not logged in!'
    });
  }
});

app.get('/reports', (req, res) => {
  let sucQ = `SELECT 
                unit_address,
                client_id,
                CONCAT(client_fname, ' ', client_fname) AS 'clientName',
                client_phoneno,
                client_email,
                checkout_date,
                trans_date,
                DATEDIFF(checkout_date, res_date) * price_per_night AS 'amount'
              FROM
                succ_trans
                    NATURAL JOIN
                reservation
                    NATURAL JOIN
                units
                    NATURAL JOIN
                client
              WHERE
                prov_id = ? 
                    AND res_status = 'Successful'`;
  con.query(sucQ, [req.session.provId], (err, results) => {
    success = results;
    if (!err) {
      if (req.session.username) {
        res.render('reports', {
          user: req.session.username.replace(/\b\w/g, l => l.toUpperCase()),
          profilePic: req.session.profPic,
          success: success,
          report: {
            earnings: '',
            from: '',
            to: ''
          }
        });
      } else {
        res.render('index', {
          message: 'You are not logged in!'
        });
      }
    } else {
      console.log('sucQ failed');
    }
  });
});

app.post('/monthly-report', (req, res) => {
  con.query('SELECT  trans_date, amount, SUM(amount) as "earnings" FROM succ_trans WHERE trans_date >= ? && trans_date <= ?', [req.body.sDate, req.body.eDate], (err, results) => {
    res.render('reports', {
      user: req.session.username.replace(/\b\w/g, l => l.toUpperCase()),
      profilePic: req.session.profPic,
      success: success,
      report: {
        amount: results[0].earnings,
        from: req.body.eDate,
        to: req.body.eDate
      }
    });
  });
});

app.post('/new-unit', (req, res) => {
  con.query(`INSERT INTO units (prov_id, condo_name, unit_description, unit_capacity, unit_address, no_of_beds, price_per_night) VALUES (?, ?, ?, ?, ?, ?, ?)`, [req.session.provId, req.body.unitName, req.body.desc, req.body.unitCap, req.body.unitAdd, req.body.bedNo, req.body.price], (err, results) => {
    res.redirect(302, '/unit-image');
  });
});

app.get('/unit-image', (req, res) => {
  con.query('SELECT units.trans_id, prov_id FROM units NATURAL JOIN unit_pics GROUP BY trans_id HAVING prov_id = ?', [req.session.provId], (err, rows) => {
    res.render('addUnitPic', {
      user: req.session.username.replace(/\b\w/g, l => l.toUpperCase()),
      profilePic: req.session.profPic,
      units: rows
    });
  });
});

app.post('/add-unit-image', (req, res) => {
  upload(req, res, err => {
    if (err) {
      res.redirect(302, '/new-entry');
    } else {
      res.render('addUnitPic', {
        user: req.session.username.replace(/\b\w/g, l => l.toUpperCase()),
        profilePic: req.session.profPic,
        units: rows.trans_id
      });
      con.query('INSERT INTO unit_pics (trans_id, picture) VALUES (?, ?)', [req.body.uId, req.file.filename], (err, results) => {
        console.log(`Inserted ${req.file.filename}`);
      });
    }
  }); 
});

app.post('/accept', (req, res) => {
  con.query(`UPDATE reservation SET res_status="Accepted" WHERE res_id=?`, [req.body.resId], (err, row) => {
    if (err) {
      console.log(err);
    }
  });
  res.redirect(302, '/');
});

app.post('/cancel', (req, res) => {
  con.query(`UPDATE reservation SET res_status="Cancelled" WHERE res_id=?`, [req.body.resId], (err, row) => {
    if (err) {
      console.log(err);
    }
  });
  res.redirect(302, '/');
});

app.post('/book', (req, res) => {
  con.query(`UPDATE reservation SET res_status="Booked" WHERE res_id=?`, [req.body.resId], (err, row) => {
    if (!err) {
      con.query('select * from units where trans_id = (select trans_id from units natural join reservation where res_id=?)', [req.body.resId], (err, results) => {
        con.query('update units set vacancy="occupied" where trans_id = ?', [results[0].trans_id], (err, trans) => {
          console.log('updated vacancy');
        });
      });
      console.log(err);
    }
  });
  res.redirect(302, '/');
});

app.post('/success', (req, res) => {
  con.query('UPDATE reservation SET res_status="Successful" WHERE res_id=?', [req.body.resId], (err, row) => {
    if (!err) {
      let sucQ = `SELECT 
                      DATEDIFF(checkout_date, res_date) * price_per_night AS amount
                  FROM
                      reservation
                          NATURAL JOIN
                      units
                  WHERE
                      prov_id = ? AND res_id = ?`;
      con.query(sucQ, [req.session.provId, req.body.resId], (err, result) => {
        if (!err) {
          con.query('INSERT INTO succ_trans (trans_date, amount, res_id, share, prov_id) VALUES (?, ?, ?, ?, ?)', [date, result[0].amount, req.body.resId, (result[0].amount * 0.1), req.session.provId], (err, row) => {
            if (!err) {
              con.query('select * from units where trans_id = (select trans_id from units natural join reservation where res_id=?)', [req.body.resId], (err, results) => {
                con.query('update units set vacancy="vacant" where trans_id = ?', [results[0].trans_id], (err, trans) => {
                  console.log('updated vacancy');
                });
              });
              console.log('query success');
              res.redirect(302, '/');
            } else {
              console.log(err);
            }
          });
        }
      });
      console.log('success!');
    } else {
      console.log('success failed');
    }
  });
});

app.post('/deny', (req, res) => {
  con.query(`UPDATE reservation SET res_status="Denied" WHERE res_id=?`, [req.body.resId], (err, results) => {
    res.redirect(302, '/dashboard');
  });
});

app.listen(port, host, () => {
  console.log(tc.text('suc', `\nConnected to ${host} on port ${port}!`));
});