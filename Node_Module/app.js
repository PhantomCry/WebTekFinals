const http = require('http');
const fs = require('fs');
const mysql = require('mysql');

const host = 'localhost';
const port = 3000;

const db = 'webtekfinals';

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
    var sql = 'SELECT * FROM webtekfinalstable';
    // var sql = 'INSERT INTO webtekfinalstable (name) VALUES ("test")';

    // Query to the database
    con.query(sql, (err, result) => {
        if (err) {
            throw err;
        }
        result.forEach(row => {
            console.log(row.id + ' ' + row.name); // Database data (Similar to JSON)
        });
    });
});

// Create server connection
const server = http.createServer((req, res) => {
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
});

// Listen to port
server.listen(port, host, () => {
    console.log('Listening to ' + host + ' on port ' + port);
});