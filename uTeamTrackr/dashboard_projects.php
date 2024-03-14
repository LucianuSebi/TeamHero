<?php session_start();
error_reporting(E_ERROR | E_PARSE);
include "db_conn.php";
$search = mysqli_real_escape_string($conn, $_GET['search']);
$org = $_SESSION['organization']['uOrg'];
if (!(empty($_GET['search']))) {
    $sql = "SELECT * FROM projects WHERE Org= '$org'";
    $sql_result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($sql_result);
} else
    $sql = "SELECT * FROM projects WHERE org = '$org'";
$sql_result = mysqli_query($conn, $sql);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/f3d0c2ca4c.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Start-up Page</title>
    <style>
        .pageContent {
            overflow: auto;
            position: absolute;
            left: 15%;
            top: 0%;
            width: 85%;
            height: 100%;
            background-color: #cfadfc;
            background-size: cover;
            display: block;
        }

        .searchForm {
            width: 600px;
            max-width: 70%;
            background: rgba(299, 39, 147, 0.2);
            display: flex;
            align-items: center;
            border-radius: 60px;
            padding: 10px 20px;
            backdrop-filter: blur(4px) saturate(180%);
        }

        .searchForm input {
            background: transparent;
            flex: 1;
            border: 0;
            outline: none;
            padding: 24px 20px;
            font-size: 20px;
        }

        .searchForm button {
            border: 0;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            cursor: pointer;
            background-color: white;
        }

        .search-box {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 40%;
            padding-bottom: 20px;
        }

        .categorii {
            width: 100%;
            justify-content: center;
            flex-wrap: wrap;
            display: flex;
            overflow: auto;
            margin-top: 40px;
            margin-bottom: 40px;
        }

        .categorie {
            width: 350px;
            height: 350px;
            margin: 30px;
            background-color: #632793;
            text-decoration: none;
            transform: scale(1.0);
            transition: transform 0.3s ease;
        }

        .categorie:hover {
            transform: scale(1.1);
        }

        .categorie img {
            width: inherit;
            height: inherit;
            object-fit: contain;
            opacity: 90%;
        }

        .categorie p {
            text-align: center;
            transform: translateY(-50%);
            font-weight: bold;
            color: #000000;
            font-size: 50px;
        }
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

    <div class="pageContent">
        <div class="categorii">
            <?php while ($row = mysqli_fetch_assoc($sql_result)) {

                if (!(empty($_GET['search']))) {
                    ?><a class="categorie" href="edit_projects.php?project=<?php echo $row['ID']; ?>"><img
                            id="poza-categorie" src="images/projects/<?php echo $row['ID']; ?>.png" />
                        <p class="titlu-categorie">
                            <?php echo $row['name']; ?>
                        </p>
                    </a>
                    <?php
                } else {
                    ?><a class="categorie" href="edit_projects.php?project=<?php echo $row['ID']; ?>"><img
                            id="poza-categorie" src="images/projects/<?php echo $row['ID']; ?>.png" />
                        <p class="titlu-categorie">
                            <?php echo $row['name']; ?>
                        </p>
                    </a>
                    <?php
                }
            } ?>
        </div>
    </div>

</body>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('.categoryHeader');

        buttons.forEach(function (button) {
            button.addEventListener('click', function () {
                const list = this.nextElementSibling;
                if (list.style.height === '') {
                    list.style.height = '0px';
                }
                else {
                    list.style.height = '';
                }
            });
        });
    });
</script>

<script>
    let categorie = document.getElementById("poza-categorie");
    var titlu = document.querySelectorAll('.titlu-categorie');
    for (var i = 0; i < titlu.length; i++) {
        titlu[i].style.position = "relative";
        titlu[i].style.top = -categorie.height / 2 + "px";
    }

</script>