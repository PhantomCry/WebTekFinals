const http = require('http');
const fs = require('fs');
const mysql = require('mysql');
const sha256 = require('sha256');
const qs = require('querystring');
const tc = require('./text-color');

const host = 'localhost';
const port = 3000;
const db = 'webtekfinals';
const sql = 'SELECT * FROM webtekfinalstable';
let tableRow;

// Create database connection variable
const con = mysql.createConnection({
  host: host,
  user: 'root',
  password: '',
  database: db
});

// Connect to database
con.connect(err => {
  if (err) {
    throw err;
  }
  console.log(tc.success(`Connected to ${db} database!`));
});

// Query to the database
con.query(sql, (err, result) => {
  if (err) {
    throw err;
  }
  tableRow = result;
});

// Server Connection
http.createServer((req, res) => {
  if (req.method === 'GET') {
    switch (req.url) {
      case '/':
        renderHTML(res, './public/index.html', 'text/html');
        break;
      case '/styles/style.css':
        renderHTML(res, './public/styles/style.css', 'text/css');
        break;
      default:
        res.writeHead(404, {
          'Content-type': 'text/plain'
        });
        res.end('404 Not found!');
        break;
    }
  } else if (req.method === 'POST') {
    req.on('data', chunk => {
      let username = qs.parse(chunk.toString()).username;
      let password = sha256(qs.parse(chunk.toString()).password);
      tableRow.forEach(row => {
        if (username.toLowerCase() == row.username.toLowerCase()) { // To avoid case sensitivity
          console.log(tc.success('Username matched!'));
          if (password === row.password) {
            console.log(tc.success('Password matched!'));
            renderHTML(res, './public/dashboard.html', 'text/html');
          } else {
            console.log(tc.error('wrong password'));
          }
        } else {
          console.log(tc.error('no such username!'));
        }
      });
    });
  } else {
    fs.readFile(path, (err, content) => {
      res.writeHead(200, {
        'Content-type': 'text/html'
      });
      res.end('Request error');
    });
  }
}).listen(port, host, () => { // Listen to port
  console.log(tc.info(`\nListening to ${host} on port ${port}`));
});

// Render html code
let renderHTML = (res, path, mime) => {
  fs.readFile(path, (err, content) => {
    res.writeHead(200, {
      'Content-type': mime
    });
    res.write(content);
    res.end();
  });
}