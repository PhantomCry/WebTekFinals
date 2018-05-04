# Node useful links
* [Basics](https://www.youtube.com/watch?v=U8XF6AFGqlc)
* [Node js routing](https://www.youtube.com/watch?v=tiMLxUKrB-g)
* [MySQL](https://www.youtube.com/watch?v=EN6Dx22cPRI)
* [Node MySQL query](https://www.w3schools.com/nodejs/nodejs_mysql_select.asp)
* [Serve multiple files](https://stackoverflow.com/questions/49967578/how-do-i-serve-multiple-files-without-express)
* [Node MySQL valuable information](https://www.youtube.com/watch?v=XuLRKMqozwA)
* [Node handling post request](https://itnext.io/how-to-handle-the-post-request-body-in-node-js-without-using-a-framework-cd2038b93190)
* [Node js get form input](https://www.w3schools.com/nodejs/ref_querystring.asp)

## Required modules
* `npm install --save-dev nodemon` or `npm install -g nodemon` (optional - automatic server restart)
* `npm install mysql`
* `npm install sha256`

### How to change domain name of server

Step 1: Open WAMP server. Then left-click on the Wamp Icon
Step 2: Under Apache, select httpd.conf
Step 3: Change the port number to 3000 (or any number except 80) of the following lines to desired port:

Listen 0.0.0.0:3000
Listen [::0]:3000

ServerName localhost:3000

Step 4: Change the hosts file to 127.0.0.1 transientvania.com
Step 5: Inside the Node app change the port number of the server to port 80
Step 6: Restart Wamp Server.
Step 7: Run Node app and test on the browser.