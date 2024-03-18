<?php
session_start();
$token = mysqli_real_escape_string($conn, $_GET['token']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/signup.css">
    <script src="https://kit.fontawesome.com/f3d0c2ca4c.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Start-up Page</title>

</head>

<body>

    <div class="container">
        <div class="form-box" id="formBox">
            <h1 id="title">Sign Up</h1>
            <form id="loginForm" action="php_modules/register_user.php" method="post">

                <h2 id="userTitle">User Details</h2>
                <div class="input-group" id="inputGroup">
                    <div class="input-field" id="userFirstName">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" name="fName" placeholder="First Name">
                    </div>

                    <div class="input-field" id="userLastName">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" name="lName" placeholder="Last Name">
                    </div>

                    <div class="input-field" id="userPhone">
                        <i class="fa-solid fa-phone"></i>
                        <input type="tel" name="uPhone" placeholder="Phone Number">
                    </div>

                    <div class="input-field" id="userEmail">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="text" name="uEmail" placeholder="Email">
                    </div>

                    <div class="input-field" id="userPass">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" name="uPass" placeholder="Password">
                    </div>

                    <div class="input-field" id="userPassVerif">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" name="uRePass" placeholder="Retype Password">
                    </div>

                    <input type="hidden" name="token" value="<?php echo $token ?>">

                </div>

                <div class="btn-connect">
                    <button type="submit" id="connectBtn">Register</button>
                </div>

            </form>

        </div>
    </div>
</body>