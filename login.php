<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in to your account</title>
    <link rel="stylesheet" href="/CSS/fonts.css">
    <link rel="stylesheet" href="/CSS/style.css">
    <link rel="stylesheet" href="/FontAwesome6/css/all.min.css">
    <script src="/JS/jquery.min.js"></script>
    <script src="/JS/script.js"></script>
    <script src="/JS/login.js"></script>
    <style>
        main {
            background: #fff url("/Images/login-background.jpg") center/cover no-repeat;
            background-attachment: fixed;
        }
    </style>
</head>

<body>
    <header class="header">
        <?php include('navbar.php'); ?>
    </header>
    <main>
        <div class="login">
            <form action="?" method="POST" autocomplete="off" name="register-form" style="display:none;">
                <h1>Register / Sign Up</h1>
                <div class="two-in-a-row">
                    <div class="row">
                        <div class="input-group">
                            <label for="name" class="icon">A</label>
                            <input type="text" name="name" id="name" placeholder="Enter Your Full Name..." required="required">
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group">
                            <label for="code-massar">Code Massar</label>
                            <input type="text" name="code-massar" id="code-massar" placeholder="Enter Your Code Massar..." required="required">
                        </div>
                    </div>
                </div>
                <div class="input-group my-2">
                    <label for="email" class="icon">@</label>
                    <input type="email" name="email" id="email" placeholder="Enter Your Email..." required="required">
                </div>
                <div class="two-in-a-row">
                    <div class="row">
                        <div class="input-group">
                            <label for="password" class="icon"><i class="fa-solid fa-key"></i></label>
                            <input type="password" name="password" id="password" placeholder="Type a Password..." required="required">
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group">
                            <label for="password-confirmation" class="icon"><i class="fa-solid fa-key"></i></label>
                            <input type="password" name="password-confirmation" id="password-confirmation" placeholder="Re-Type it !" required="required">
                        </div>
                    </div>
                </div>
                <div class="input-group my-2">
                    <label for="birthday" class="icon"><i class="fa-solid fa-cake-candles"></i></label>
                    <input type="date" name="birthday" id="birthday" required="required">
                </div>
                <div class="input-group my-4">
                    <label for="phone-number" class="icon"><i class="fa-solid fa-phone"></i></label>
                    <input type="text" name="phone-number" id="phone-number" placeholder="Enter Your Phone Number..." required="required">
                </div>
                <div class="my-2 align-center">
                    <input type="button" value="Login" name="login" id="login" onclick="ShowLoginForm()">
                    <input type="submit" value="Register" name="register" id="register">
                </div>
            </form>
            <form action="?" method="POST" autocomplete="off" name="login-form">
                <h1>Login / Sign In</h1>
                <div class="two-in-a-row">
                    <div class="row">
                        <div class="input-group">
                            <label for="code-massar">Code Massar</label>
                            <input type="text" name="code-massar" id="code-massar" placeholder="Enter Your Code Massar..." required="required">
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group">
                            <label for="password" class="icon"><i class="fa-solid fa-key"></i></label>
                            <input type="password" name="password" id="password" placeholder="Enter your Password..." required="required">
                        </div>
                    </div>
                </div>
                <div class="my-2 align-center">
                    <input type="button" value="Register" name="register" id="register" onclick="ShowRegisterForm()">
                    <input type="submit" value="Login" name="login" id="login">
                </div>
            </form>
        </div>
    </main>
</body>

</html>