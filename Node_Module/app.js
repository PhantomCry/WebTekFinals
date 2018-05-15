const express = require('express');
const session = require('express-session');
const bodyParser = require('body-parser');
const mysql = require('mysql');
const sha256 = require('sha256');
const multer = require('multer');
const path = require('path');
const tc = require('./text-color');

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

const app = express();

const host = '192.168.1.6';
const port = 3000;
const db = 'transient';

let username;
let prov_pic;
let password;
let pendingReq;
let accepted;
let book;
let provId;

const con = mysql.createConnection({
  host: 'localhost',
  user: 'root',
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
      user: username,
      profilePic: provPic
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
      req.session.username = username;
      req.session.username = password;
      provId = results[0].prov_id;
      provPic = results[0].prov_pic;
      console.log(tc.text('info', `${results[0].prov_username} logged in!`));

      res.redirect(302, '/dashboard');
    } else {
      res.render('index', {
        message: 'Wrong username or password!'
      });
    }
  });
});

app.get('/dashboard', (req, res) => {

  con.query(`SELECT unit_address, client_id, client_fname, client_lname, no_of_tenents, client_phoneno, client_email, res_date, checkout_date, res_id FROM units Natural JOIN reservation Natural Join client where prov_id=${provId} and res_status="Under Review"`, (err, row) => {
    pendingReq = row;
  });
  con.query(`SELECT unit_address, client_id, client_fname, client_lname, no_of_tenents, client_phoneno, client_email, res_date, checkout_date, res_id FROM units Natural JOIN reservation Natural Join client where prov_id=${provId} and res_status="Accepted"`, (err, row) => {
    accepted = row;
  });
  con.query(`SELECT unit_address, client_id, client_fname, client_lname, no_of_tenents, client_phoneno, client_email, res_date, checkout_date, res_id FROM units Natural JOIN reservation Natural Join client where prov_id=${provId} and res_status="Booked"`, (err, row) => {
    book = row;

    if (req.session.username) {
      res.render('dashboard', {
        user: username,
        profilePic: provPic,
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
    con.query(`select units.trans_id, prov_id, condo_name, unit_description, unit_capacity, unit_address, no_of_beds, price_per_night, vacancy, post_status, upic_id, picture from units left join unit_pics on units.trans_id = unit_pics.trans_id group by trans_id having prov_id = ?`, [provId], (err, results) => {
      res.render('listings', {
        user: username,
        profilePic: provPic,
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
      user: username,
      profilePic: provPic
    });
  } else {
    res.render('index', {
      message: 'You are not logged in!'
    });
  }
});

app.post('/new-unit', (req, res) => {
  con.query(`INSERT INTO units (prov_id, condo_name, unit_description, unit_capacity, unit_address, no_of_beds, price_per_night) VALUES (${provId}, '${req.body.unitName}', '${req.body.desc}', ${req.body.unitCap}, '${req.body.unitAdd}', ${req.body.bedNo}, ${req.body.price})`, (err, results) => {
    console.log('Insert Success');
    res.redirect(302, '/unit-image');
  });
});

app.get('/unit-image', (req, res) => {
  res.render('addUnitPic', {
    user: username,
    profilePic: provPic
  });
});

app.post('/add-unit-image', (req, res) => {
  upload(req, res, err => {
    if (err) {
      res.redirect(302, '/new-entry');
    } else {
      res.render('addUnitPic', {
        user: username,
        profilePic: provPic
      });
      con.query('INSERT INTO unit_pics (trans_id, picture) VALUES (?, ?)', [req.body.uId, req.file.filename], (err, results) => {
        console.log('insert success!');
      });
    }
  });
});

app.post('/accept', (req, res) => {
  con.query(`UPDATE reservation SET res_status="Accepted" WHERE res_id=${req.body.resId}`, (err, row) => {
    if (err) {
      console.log(err);
    }
  });
  res.redirect(302, '/');
});

app.post('/cancel', (req, res) => {
  con.query(`UPDATE reservation SET res_status="Under Review" WHERE res_id=${req.body.resId}`, (err, row) => {
    if (err) {
      console.log(err);
    }
  });
  res.redirect(302, '/');
});

app.post('/book', (req, res) => {
  con.query(`UPDATE reservation SET res_status="Booked" WHERE res_id=${req.body.resId}`, (err, row) => {
    if (err) {
      console.log(err);
    }
  });
  res.redirect(302, '/');
});

app.listen(port, host, () => {
  console.log(tc.text('suc', `\nConnected to ${host} on port ${port}!`));
});