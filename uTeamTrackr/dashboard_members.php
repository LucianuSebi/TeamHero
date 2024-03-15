<?php session_start();
error_reporting(E_ERROR | E_PARSE);
include "db_conn.php";
$search = mysqli_real_escape_string($conn, $_GET['search']);
$org = $_SESSION['organization']['uOrg'];
if (!(empty($_GET['search']))) {
    $sql = "SELECT * FROM users WHERE FName like '%$search%' OR LName like '%$search%' AND Org= '$org'";
    ;
    $sql_result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($sql_result);
} else
    $sql = "SELECT * FROM users WHERE org = '12'";
$sql_result = mysqli_query($conn, $sql);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/style.css">
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
            width: 300px;
            border-radius: 10px;
            height: auto;
            margin: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #632793;
            text-decoration: none;
            transform: scale(1.0);
            transition: transform 0.3s ease;
        }

        .categorie:hover {
            transform: scale(1.05);
        }

        .categorie img {
            background-color: white;
            margin-top: 50px;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: contain;
            opacity: 90%;
        }

        .titlu-categorie {
            margin-top: 30px;
            margin-bottom: 0px;
            text-align: center;
            font-weight: bold;
            color: #000000;
            font-size: 20px;
        }

        .rank-categorie {
            margin-top: 10px;
            padding-left: 30px;
            padding-right: 30px;
            padding-bottom: 7px;
            margin-bottom: 0px;
            text-align: center;
            font-weight: bold;
            color: gray;
            border-bottom: 1px solid rgb(200, 200, 200);
            font-size: 17px;
        }

        .manage-categorie {
            margin-top: 40px;
            margin-bottom: 0px;
            padding-bottom: 50px;
            text-align: center;
            font-weight: bold;
            color: #5F2C67;
            font-size: 20px;
            cursor: pointer;
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
        <div class="search-box">
            <form action="" class="searchForm">
                <input type="text" placeholder="Search For A Member" name="search" id="searchField" autocomplete="off">
                <button type="submit" id="searchBtn"><i class="fa-solid fa-magnifying-glass fa-2xl"></i></button>
            </form>
        </div>
        <div class="categorii">
            <?php while ($row = mysqli_fetch_assoc($sql_result)) {
                if (!(empty($_GET['search']))) {
                    ?><a class="categorie" href="edit_user.php?user=<?php echo $row['ID']; ?>"><img id="poza-categorie"
                            src="images/users/<?php echo $row['ID']; ?>.png" />
                        <p class="titlu-categorie">
                            <?php echo $row['FName'];
                            echo " " . $row['LName']; ?>
                        </p>
                        <p class="rank-categorie">
                            <?php echo $row['Rank']; ?>
                        </p>
                        <p class="manage-categorie">
                            MANAGE
                        </p>
                    </a>
                    <?php
                } else {
                    ?><a class="categorie" href="edit_user.php?user=<?php echo $row['ID']; ?>"><img id="poza-categorie"
                            src="images/users/<?php echo $row['ID']; ?>.png" />
                        <p class="titlu-categorie">
                            <?php echo $row['FName'];
                            echo " " . $row['LName']; ?>
                        </p>
                        <p class="rank-categorie">
                            <?php echo $row['Rank']; ?>
                        </p>
                        <p class="manage-categorie">
                            MANAGE
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