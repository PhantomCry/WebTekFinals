const express = require('express');
const session = require('express-session');
const bodyParser = require('body-parser');
const mysql = require('mysql');
const sha256 = require('sha256');
const multer = require('multer');
const path = require('path');
const tc = require('./text-color');

const storage = multer.diskStorage({
  destination: './views/uploads/',
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

const host = 'localhost';
const port = 3000;
const db = 'transient';

let username;
let password;
let pendingReq;
let accepted;
let book;
let provId;

const con = mysql.createConnection({
  host: host,
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
      user: username
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

  con.query(`SELECT * FROM provider WHERE prov_username='${username}' AND prov_pswd='${password}'`, (err, results) => {
    if (results.length) {
      req.session.username = username;
      req.session.username = password;
      provId = results[0].prov_id;
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
  
  con.query(`SELECT unit_address, client_id, client_fname, client_lname, no_of_tenents, client_phoneno, client_email, res_date, checkout_date, res_id FROM trans_unit Natural JOIN reservation Natural Join client where prov_id=${provId} and res_status="Under Review"`, (err, row) => {
    pendingReq = row;
  });
  con.query(`SELECT unit_address, client_id, client_fname, client_lname, no_of_tenents, client_phoneno, client_email, res_date, checkout_date, res_id FROM trans_unit Natural JOIN reservation Natural Join client where prov_id=${provId} and res_status="Accepted"`, (err, row) => {
    accepted = row;
  });
  con.query(`SELECT unit_address, client_id, client_fname, client_lname, no_of_tenents, client_phoneno, client_email, res_date, checkout_date, res_id FROM trans_unit Natural JOIN reservation Natural Join client where prov_id=${provId} and res_status="Booked"`, (err, row) => {
    book = row;

    if (req.session.username) {
      res.render('dashboard', {
        user: username,
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
    con.query(`SELECT * FROM trans_unit WHERE prov_id=${provId}`, (err, results) => {
      res.render('listings', {
        user: username,
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
      user: username
    });
  } else {
    res.render('index', {
      message: 'You are not logged in!'
    });
  }
});

app.post('/new-unit', (req, res) => {
  upload(req, res, err => {
    if (err) {
      res.render('new-entry', {
        profPic: `uploads/${req.file.filename}` // not working! should replace the profile pic
      });
    } else {
      res.redirect(302, '/new-entry');
    }
    con.query(`INSERT INTO trans_unit (unit_pic, unit_desccription, unit_capacity, unit_address, price_per_night, prov_id) VALUES ('${req.file.filename}', '${req.body.desc}', '${req.body.unitCap}', '${req.body.unitAdd}', '${req.body.price}', '${provId}')`, (err, results) => {
      console.log('Insert Success');
    });
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