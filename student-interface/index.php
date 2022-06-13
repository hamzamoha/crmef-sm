<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to The Student Plateform</title>
    <link rel="stylesheet" href="/CSS/fonts.css">
    <link rel="stylesheet" href="/CSS/style.css">
    <link rel="stylesheet" href="/FontAwesome6/css/all.min.css">
    <script src="/JS/jquery.min.js"></script>
    <script src="/JS/script.js"></script>
</head>

<body>
    <header class="header">
        <?php include(__DIR__ . '/navbar.php'); ?>
        <div class="wall">
            <div>
                <h1>Welcome</h1>
                <p>Education is Fun! Today We all Gonna Find Out How We Can Use Websites Without Internet. Follow Along With The Instruction And Everything Will Be Just Fine. Good Luck Everyone :)</p>
                <button class="wall-button">Sign Up</button>
                <div class="tiles">
                    <div class="tile">
                        <i class="fa-solid fa-link"></i>
                        <h3>Exams</h3>
                        <p>Pass Exams Online</p>
                    </div>
                    <div class="tile">
                        <i class="fa-solid fa-graduation-cap"></i>
                        <h3>Courses</h3>
                        <p>Access to Courses</p>
                    </div>
                    <div class="tile">
                        <i class="fa-regular fa-comments"></i>
                        <h3>Contact</h3>
                        <p>Easy Contact</p>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main class="main">
        <div class="boxes">
            <div class="box">
                <div class="inner-box">
                    <div class="thumbnail">
                        <img src="/Images/high-school.jpg" alt="High School">
                        <div class="thumbnail-overlay">
                            <button class="thumbnail-overlay-button">Know More</button>
                        </div>
                    </div>
                    <h3>High School</h3>
                    <p>high school courses, exams and tutorials</p>
                </div>
            </div>
            <div class="box">
                <div class="inner-box">
                    <div class="thumbnail">
                        <img src="/Images/middle-school.jpg" alt="Middle School">
                        <div class="thumbnail-overlay">
                            <button class="thumbnail-overlay-button">Know More</button>
                        </div>
                    </div>
                    <h3>Middle School</h3>
                    <p>Middle school courses, exams and tutorials</p>
                </div>
            </div>
            <div class="box">
                <div class="inner-box">
                    <div class="thumbnail">
                        <img src="/Images/college.jpg" alt="BTS">
                        <div class="thumbnail-overlay">
                            <button class="thumbnail-overlay-button">Know More</button>
                        </div>
                    </div>
                    <h3>BTS</h3>
                    <p>Brevet de Technicien Supérieur</p>
                </div>
            </div>
        </div>
        <div class="title-on-border">
            <div class="title-border">
                <span class="title-text">About Us</span>
            </div>
            <div class="content">
                <div class="about-us">
                    <div class="about-us-sidebar">
                        <div class="avatar">
                            <img src="/Images/avatar.png" alt="Avatar">
                        </div>
                        <div class="name">
                            Mr. Smith
                        </div>
                    </div>
                    <div class="short-story">
                        <p>My name is Ann Smith. I am a senior in high school. Everyone can agree that I am a good student and that I like to study. My favorite subjects are chemistry and biology. I am going to enter the university because my goal is to study these subjects in future and to become a respected professional in one of the fields.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <div class="footer-dummy">Footer Dummy - <a href="#">Footer Link</a></div>
    </footer>
</body>

</html>