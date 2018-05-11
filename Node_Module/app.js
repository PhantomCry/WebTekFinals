const express = require('express');
const session = require('express-session');
const bodyParser = require('body-parser');
const mysql = require('mysql');
const sha256 = require('sha256');
const tc = require('./text-color');

const app = express();

const host = 'localhost';
const port = 3000;
const db = 'transient';

let sql = 'SELECT * FROM provider';
let dbData;
let username;
let password;

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
con.query(sql, (err, rows) => {
  if (err) {
    console.log(tc.text('error', 'database query error!'));
    throw err;
  } else {
    dbData = rows;
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

app.get('/dashboard', (req, res) => {
  if (req.session.username) {
    res.render('dashboard', {
      user: username
    });
  } else {
    res.render('index', {
      message: 'You are not logged in!'
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
      res.render('dashboard', {
        user: results[0].prov_username
      });
      console.log(tc.text('info', `${results[0].prov_username} logged in!`));
    } else {
      res.render('index', {
        message: 'Wrong username or password!'
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
    res.render('listings', {
      user: username
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

app.listen(port, host, () => {
  console.log(tc.text('suc', `\nConnected to ${host} on port ${port}!`));
});