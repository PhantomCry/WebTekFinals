const http = require('http');
const fs = require('fs');
const mysql = require('mysql');
const sha256 = require('sha256');
const qs = require('querystring');

const host = 'localhost';
const port = 3000;

const db = 'webtekfinals';
const sql = 'SELECT * FROM webtekfinalstable';
let tableRow;

// Create database connection variable
const con = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',
  database: db
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
  tableRow = result;
  // console.log('Raw data from db:', result);
  // result.forEach(row => {
  //   console.log('Filtered data from db:', row.id, row.username, row.password); // Database data (Similar to JSON)
  // });
});

// Server Connection
http.createServer((req, res) => {
  if (req.method === 'POST') {
    req.on('data', chunk => {
      let username = qs.parse(chunk.toString()).username;
      let password = sha256(qs.parse(chunk.toString()).password);
      tableRow.forEach(row => {
        if (username == row.username) {
          console.log(username, 'and', row.username, 'matched!');
          if (password === row.password) {
            console.log(password, 'and', row.password, 'matched!');
          } else {
            console.log('wrong password');
          }
        } else {
          console.log('no such username!');
        }
      });
    });
  }


  switch (req.url) {
    case '/':
      renderer(res, './public/index.html', 'text/html');
      break;
    case '/styles/style.css':
      renderer(res, './public/styles/style.css', 'text/css');
      break;
    default:
      res.writeHead(404, {
        'Content-type': 'text-plain'
      });
      res.end('404 Not found!');
      break;
  }
}).listen(port, host, () => { // Listen to port
  console.log('Listening to ' + host + ' on port ' + port);
});

let renderer = (res, path, mime) => {
  fs.readFile(path, (err, content) => {
    res.writeHead(200, {
      'Content-type': mime
    });
    res.write(content);
    res.end();
  });
}