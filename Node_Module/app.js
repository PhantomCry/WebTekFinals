const http = require('http');
const fs = require('fs');
const mysql = require('mysql');

const host = 'localhost';
const port = 3000;

// Create database connection
const con = mysql.createConnection({
    host        : 'localhost',
    user        : 'root',
    password    : '',
    database    : 'webtekfinals'
});

// Connect to database
con.connect(err => {
    if (err) {
        throw err;
    }
    console.log('Connected to DB');
    var sql = 'SELECT * FROM webtekfinalstable';
    // var sql = 'INSERT INTO webtekfinalstable (name) VALUES ("test")';

    // Query to the database
    con.query(sql, (err, result) => {
        if (err) {
            throw err;
        }
        console.log(result); // this results as a n object (which means it can be manipulated vie normal js)
    });
});

// Create server connection
const server = http.createServer((req, res) => {
    res.statusCode = 200;
    res.setHeader('Content-type', 'text/plain');
    res.end('This is a text');
});

// Connect to server
server.listen(port, host, () => {
    console.log('Connected to ' + host + ' on port ' + port);
});