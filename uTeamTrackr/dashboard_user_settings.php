<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/f3d0c2ca4c.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Settings</title>
    <style>
        <center>
        body{
            front-family: Arial , sans-serif;
            background color: #4f4f4f;
            margin: 100;
            padding: 0;
        }
    
        h2{
            margin-top: 200;
            text-align: center;
        }
        label{
            front-weight: bold;

        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="file"],
        input[type="submit"]{
            width:100%;
            padding:10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius:5px;
            box-sizing:boreder-box;
        }
        input[type="submit"] {
            background-color: #007bff;
            color:#fff;
            border: none;
        }
        </center>
        </style>

</head>

<body>
    
    <div class="leftBar">
        <div class="logo">

        </div>

        <div class="category">

            <div class="categoryHeader">
                <p>PROJECTS</p>
                <i class="fa-solid fa-angle-up"></i>
            </div>

            <ul>
                <li>
                    <a href="#">Your Project</a>
                </li>
            </ul>

        </div>
        <div class="category">

            <div class="categoryHeader">
                <p>MANAGE</p>
                <i class="fa-solid fa-angle-up"></i>
            </div>

            <ul>
                <li>
                    <a href="#">Feeds</a>
                </li>
                <li>
                    <a href="#">Your Account</a>
                </li>
                <li>
                    <a href="#">Monitoring</a>
                </li>
                <li>
                    <a href="#">Chats</a>
                </li>
            </ul>

        </div>
        <div class="category">

            <div class="categoryHeader">
                <p>ADMINISTRATION</p>
                <i class="fa-solid fa-angle-up"></i>
            </div>

            <ul>
                <li>
                    <a href="#">Members</a>
                </li>
                <li>
                    <a href="#">Projects</a>
                </li>
                <li>
                    <a href="#">Organization</a>
                </li>
            </ul>

        </div>

        <div class="category" style="padding-top:20px;border-bottom:0px;">

            <ul>
                <li>
                    <a href="">Support</a>
                </li>
                <li>
                    <a href="">Settings</a>
                </li>
                <li>
                    <a href="">What's New</a>
                </li>
            </ul>

        </div>

    </div>


    <div class="container">
        <h2> User Settings</h2>
        <div class="form-group">
            <label for="profile-picture">Profile Picture</label>
            <input type="file" id="profile-picture">
        </div>  
        <br>

        <div class="form-group">
            <label for="first-name">First Name</label>
            <input type="text" id="first-name"placeholder="Enter your first name">
        </div>  
        <br>
        <div class="form-group">
            <label for="last-name">Last Name</label>
            <input type="text" id="last-name"placeholder="Enter your last name">
        </div> 
        <br>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" id="email"placeholder="Enter your email adress">
        </div> 
        <br>
        <div class="form-group">
            <label for="last-name">Password</label>
            <input type="text" id="password"placeholder="Enter your password">
        </div> 
        <br>
        <input type="submit" value="Save Changes">

    </div>
</body>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('.categoryHeader');

        buttons.forEach(function (button) {
            button.addEventListener('click', function () {
                const list = this.nextElementSibling;
                if(list.style.height === ''){
                    list.style.height = '0px';
                }
                else{
                    list.style.height = '';
                }
            });
        });
    });
</script>