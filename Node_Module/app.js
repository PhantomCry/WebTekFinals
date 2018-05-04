const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql');
const sha256 = require('sha256');

const app = express();

const host = 'localhost';
const port = 3000;
const db = 'webtekfinals';
const sql = 'SELECT * FROM webtekfinalstable';

let dbData;

const con = mysql.createConnection({
  host: host,
  user: 'root',
  password: '',
  database: db
});
con.connect(err => {
	if (err) {
    console.log('database connection error!');
		throw err;
	} else {
    console.log(`Connected to ${db} database!`);
  }
});
con.query(sql, (err, rows, fields) => {
  if (err) {
    console.log('database query error!');
    throw err;
  } else {
    dbData = rows;
  }
});
// con.end();

app.set('view engine', 'ejs');

app.use('/styles', express.static(__dirname + '/views/styles'));
app.use(bodyParser.urlencoded({extended: false}));
app.use(bodyParser.json());

app.get('/', (req, res) => {
  res.render('index');
});

app.post('/dashboard', (req, res) => {
  let username = req.body.username;
  let password = sha256(req.body.password);
  dbData.forEach(row => {
    if (row.username.toLowerCase() == username.toLowerCase()) {
      if (row.password === password) {
        res.render('dashboard', {user: row.username});
        console.log(`${row.username} logged in!`);
      } else {
        res.end('wrong password');
      }
    } else {
      res.end('wrong username');
    }
  });
});

app.listen(port, host, () => {
  console.log(`Connected to ${host} on port ${port}!`);
});