const http = require('http');
const fs = require('fs');
const mysql = require('mysql');
const sha256 = require('sha256');

const host = 'localhost';
const port = 3000;

const db = 'webtekfinals';
const sql = 'SELECT * FROM webtekfinalstable';
// const sql = 'INSERT INTO webtekfinalstable (username, password) VALUES ("admin",\'' + sha256("admin") + '\')';

// Create database connection variable
const con = mysql.createConnection({
  host        : 'localhost',
  user        : 'root',
  password    : '',
  database    : db
});

// Connect to database
con.connect(err => {
  if (err) {
    throw err;
  }
  console.log('Connected to ' + db);
});

// Query to the database
con.query(sql, (err, result) => {
  if (err) {
    throw err;
  }
  console.log('Raw data from db:', result);
  result.forEach(row => {
    console.log(row.id, row.username, row.password); // Database data (Similar to JSON)
  });
});

// Server Connection
http.createServer((req, res) => {
  if (req.url == '/') {
      fs.readFile('./public/index.html', (err, content) => {
          res.writeHead(200, {'Content-type':'text/html'});
          res.end(content);
      });
  }
  if (req.url === '/styles/style.css') {
      fs.readFile('./public/styles/style.css', (err, content) => {
          res.writeHead(200, {'Content-type':'text/css'});
          res.end(content);
      });
  }
}).listen(port, host, () => { // Listen to port
  console.log('Listening to ' + host + ' on port ' + port);
});