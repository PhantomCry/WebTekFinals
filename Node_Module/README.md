# Node useful links
* [Basics](https://www.youtube.com/watch?v=U8XF6AFGqlc)
* [MySQL](https://www.youtube.com/watch?v=EN6Dx22cPRI)
* [Node MySQL query](https://www.w3schools.com/nodejs/nodejs_mysql_select.asp)
* [Node js get form input](https://www.w3schools.com/nodejs/ref_querystring.asp)
* [Templating Engine EJS](https://www.youtube.com/watch?v=RgAseumFyg8)
* [Serve static files (CSS)](https://expressjs.com/en/starter/static-files.html)

## Modules
* `npm install express` - the root of everything
* `npm install body-parser` - for handling post request
* `npm install ejs` - for templating engine
* `npm install mysql` - database access
* `npm install sha256` - password encryption
* `npm install --save-dev nodemon` or `npm install -g nodemon` (optional - automatic server restart)
* `npm install express body-parser ejs mysql sha256` - one line installation

## How to change domain name of server

1. Open WAMP server. Then left-click on the Wamp Icon
2. Under Apache, select `httpd.conf`
3. Change the port number to `3000` (or any number except 80) of the following lines to desired port:
   * `Listen 0.0.0.0:3000`
   * `Listen [::0]:3000`
   * `ServerName localhost:3000`
4. Change the hosts file to `127.0.0.1 transientvania.com`
5. Inside the Node app, change the port number of the server to port `80`
6. Restart Wamp Server.
7. Run Node app and test on the browser.