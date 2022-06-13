<?php require_once(__DIR__ . "/Includes/Functions.php"); ?>
<nav class="nav">
    <div class="logo">
        <!-- <img src="" alt=""> -->
        <a class="logo-link" href="/">Logo</a>
    </div>
    <ul>
        <li><a href="/" class="home">Home</a></li>
        <li><a href="#">Page1</a></li>
        <li><a href="#">List1&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-angle-down fa-2xs"></i></a>
            <ul>
                <li><a href="#">Element1</a></li>
                <li><a href="#">Element2</a></li>
                <li><a href="#">Element3</a></li>
            </ul>
        </li>
        <?php if (is_logged_in()) { ?>
            <li class="right-item"><img src="/Images/avatar.png" alt="#" class="avatar">
                <ul>
                    <li><a href="/my-space/"><i class="fa-solid fa-gauge fa-2xs"></i> My Space</a></li>
                    <li><a href="/my-space/profile.php"><i class="fa-regular fa-user fa-2xs"></i> Profile</a></li>
                    <li><a href="/my-space/settings.php"><i class="fa-solid fa-gear fa-2xs"></i> Settings</a></li>
                    <li>
                        <form action="?" method="POST" class="nav-form">
                            <button type="submit"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</button>
                        </form>
                    </li>
                </ul>
            </li>
        <?php } else { ?>
            <li class="right-item"><a href="/login.php">Sign In</a></li>
        <?php } ?>
    </ul>
</nav>