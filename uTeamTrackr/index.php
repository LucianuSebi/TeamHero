<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/index.css">
    <script src="https://kit.fontawesome.com/f3d0c2ca4c.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Start-up Page</title>

</head>

<body>
    <div class="container">

        <div class="topBar">
            <div class="topLeft">
                <h1>uTeamTrackr</h1>
            </div>
            <div class="topMiddle">
                <a href="#about">About Us</a>
                <a href="#contact">Contact</a>
            </div>
            <div class="topRight">
                <a href="register.php" class="signUp">Get Started</a>
                <a href="login.php">Login</a>
            </div>
        </div>
        <div class="section" style="">
            <img src="images/text1.png" alt="">
            <div class="signUpBar">
                <p>The Future's Right Here...</p>
                <div class="signUpBtn"><a href="register.php">Sign Up Now</a></div>
            </div>
        </div>
        <div class="section" id="about">
            <img style="padding:20px;" src="images/text2.png" alt="">
            <img style="padding:20px;" src="images/about.png" alt="">
            <img style="padding:20px;" src="images/points.png" alt="">
        </div>
        <div class="section" id="contact" style="height:100vh;">
            <img style="padding:20px;" src="images/text3.png" alt="">
            <form action="php_modules/contact.php" method="post">
                <div class="inputGroup">
                    <label for="name">Name</label>
                    <input type="text" placeholder="Your Name" name="name" id="name" required>
                </div>
                <div class="inputGroup">
                    <label for="email">Email</label>
                    <input type="text" placeholder="Email Address" name="email" id="email" required>
                </div>
                <div class="inputGroup">
                    <label for="phone">Phone</label>
                    <input type="phone" placeholder="Phone Number" name="phone" id="phone" required>
                </div>
                <div class="inputGroup">
                    <label for="city">City</label>
                    <input type="text" placeholder="City" name="city" id="city" required>
                </div>
                <div class="inputGroup" style="height: 200px;width: 100%;">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" required>Describe your inquiry...</textarea>
                </div>
                <button type="submit">Send Message</button>
            </form>
        </div>
        <div class="section" style="height:200px;padding:0">
            <img style="padding:40px;width:30%;" src="images/rights.png" alt="">
        </div>
    </div>
</body>