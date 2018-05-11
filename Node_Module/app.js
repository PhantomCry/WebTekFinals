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
con.end();

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
      callback: ''
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
      callback: 'You are not logged in!'
    });
  }
});

app.post('/dashboard', (req, res) => {
  username = req.body.username;
  let password = req.body.password;
  let falser = [];
  dbData.forEach(row => {
    if (row.prov_username.toLowerCase() == username.toLowerCase()) {
      if (row.prov_pswd === password) {
        req.session.username = username;
        req.session.username = password;
        res.render('dashboard', {
          user: row.prov_username
        });
        falser.push(true);
        console.log(tc.text('info', `${row.prov_username} logged in!`));
      } else if (row.prov_pswd !== password) {
        res.render('index', {
          callback: 'Wrong password!'
        });
        falser.push(true);
      }
    } else {
      falser.push(false);
    }
  });
  falser.every((element, index) => {
    if (element == false) {
      res.render('index', {callback: 'Username not found!'});
    }
  });
});

app.get('/logout', (req, res) => {
  req.session.destroy(err => {
    if (err) {
      res.negotiate(err);
    } else {
      res.redirect('/', {
        callback: 'test'
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
      callback: 'You are not logged in!'
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
      callback: 'You are not logged in!'
    });
  }
});

app.listen(port, host, () => {
  console.log(tc.text('suc', `\nConnected to ${host} on port ${port}!`));
});