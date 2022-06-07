<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/CSS/fonts.css">
    <link rel="stylesheet" href="/CSS/style.css">
    <link rel="stylesheet" href="/FontAwesome6/css/all.min.css">
    <script src="/JS/jquery.min.js"></script>
    <script src="/JS/script.js"></script>
</head>

<body>
    <header class="header">
        <?php include('navbar.php'); ?>
    </header>
    <main>
        <div class="login">
            <form action="?" method="POST" autocomplete="off">
                <h1>Login / Sign In</h1>
                <div class="two-in-a-row">
                    <div class="row">
                        <div class="input-group">
                            <label for="name">Name</label>
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
                    <label for="email">@</label>
                    <input type="email" name="email" id="email" placeholder="Enter Your Email..." required="required">
                </div>
                <div class="two-in-a-row">
                    <div class="row">
                        <div class="input-group">
                            <label for="password"><i class="fa-solid fa-key"></i></label>
                            <input type="password" name="password" id="password" placeholder="Type a Password..." required="required">
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group">
                            <label for="password-confirmation"><i class="fa-solid fa-key"></i></label>
                            <input type="password" name="password-confirmation" id="password-confirmation" placeholder="Re-Type it !" required="required">
                        </div>
                    </div>
                </div>
                <div class="input-group my-2">
                    <label for="birthday"><i class="fa-solid fa-cake-candles"></i> Birthday</label>
                    <input type="date" name="birthday" id="birthday" required="required">
                </div>
                <div class="input-group my-4">
                    <label for="phone-number"><i class="fa-solid fa-phone"></i></label>
                    <input type="text" name="phone-number" id="phone-number" placeholder="Enter Your Phone Number..." required="required">
                </div>
            </form>
        </div>
    </main>
</body>

</html>