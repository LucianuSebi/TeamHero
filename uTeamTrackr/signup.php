<?php
session_start();
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
            <form id="loginForm" action="php_modules/register_org.php" method="post">

            <h2 id = "orgTitle">Organization Details</h2>
            <div class="input-group" id="inputGroupOrg" style="height:300px">

                    <div class="input-field" id="orgName">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" name="cName" placeholder="Organization Name">
                    </div>

                    <div class="input-field" id="orgPhone">
                        <i class="fa-solid fa-phone"></i>
                        <input type="tel" name="cPhone" placeholder="Organization Phone Number">
                    </div>

                    <div class="input-field" id="orgEmail">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" name="cEmail" placeholder="Organization Email">
                    </div>

                    <div class="input-field" id="orgAddress">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" name="cAddress" placeholder="Organization Address">
                    </div>

                </div>

                <h2 id = "userTitle">User Details</h2>
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

                    <p>Lost Password<a href="reset_password.php"> Click Here!</a></p>
                </div>

                <div class="btn-field">
                    <button type="button" id="signupBtn">Sign Up</button>
                    <button type="button" id="signinBtn" class="disable">Sign in</button>
                </div>

                <div class="btn-connect">
                    <button type="submit" id="connectBtn">Register</button>
                </div>

            </form>

        </div>
    </div>
</body>
<script>
    let signupBtn = document.getElementById("signupBtn");
    let signinBtn = document.getElementById("signinBtn");
    let connectBtn = document.getElementById("connectBtn");
    let loginRegisterBtn = document.getElementById("loginRegisterBtn");
    let title = document.getElementById("title");
    let inputGroup = document.getElementById("inputGroup");
    let loginForm = document.getElementById("loginForm");
    let accountbtn = document.getElementById("accountbtn");

    let orgTitle = document.getElementById("orgTitle");
    let orgForm = document.getElementById("inputGroupOrg");
    let orgName = document.getElementById("orgName");
    let orgAddress = document.getElementById("orgAddress");
    let orgPhone = document.getElementById("orgPhone");
    let orgEmail = document.getElementById("orgEmail");
    let userFirstName = document.getElementById("userFirstName");
    let userLastName = document.getElementById("userLastName");
    let userPhone = document.getElementById("userPhone");
    let userEmail = document.getElementById("userEmail");
    let userPass = document.getElementById("userPass");
    let userPassVerif = document.getElementById("userPassVerif");
    let formBox = document.getElementById("formBox");

    signinBtn.onclick = function () {
        inputGroup.style.maxHeight = "240px";
        userFirstName.style.maxHeight = "0";
        userLastName.style.maxHeight = "0";
        userPhone.style.maxHeight = "0";
        userPassVerif.style.maxHeight = "0";

        orgTitle.style.display = "none";
        orgName.style.maxHeight = "0";
        orgAddress.style.maxHeight = "0";
        orgPhone.style.maxHeight = "0";
        orgEmail.style.maxHeight = "0";
        orgForm.style.display = "none";

        title.innerHTML = "Sign In";
        connectBtn.innerText = "Login";
        loginForm.action = "php_modules/login_user.php"

        signupBtn.classList.add("disable");
        signinBtn.classList.remove("disable");
    }

    signupBtn.onclick = function () {
        inputGroup.style.maxHeight = "440px";
        userFirstName.style.maxHeight = "60px";
        userLastName.style.maxHeight = "60px";
        userPhone.style.maxHeight = "60px";
        userPassVerif.style.maxHeight = "60px";

        orgTitle.style.display = "";
        orgName.style.maxHeight = "60px";
        orgAddress.style.maxHeight = "60px";
        orgPhone.style.maxHeight = "60px";
        orgEmail.style.maxHeight = "60px";
        orgForm.style.display = "block";

        title.innerHTML = "Register your Organization";
        connectBtn.innerText = "Register";
        loginForm.action = "php_modules/register_org.php"

        signinBtn.classList.add("disable");
        signupBtn.classList.remove("disable");
    }


</script>