<html>
    <head>
        
    </head>
    <link rel="stylesheet" href="style.css">
    <body>
        <div class="container">
            <section id="login-form">
                <header class="top">
                    Admin Sign-in
                </header>
                <form action="./php/login.php" method="post">
                    <label class="text-white" for="username">Username</label>
                    <input type="text" placeholder="Username" name="user" required>
                    <label class="text-white" for="pass">Password</label>
                    <input type="password" class="form-control" placeholder="Password" name="pass" required>
                    <input type="submit" name="submit" id="login" value="Login">  
                </form>
            </section>
        </div>
    </body>
</html>