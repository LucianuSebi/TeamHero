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
    <link rel="stylesheet" href="css/dashboard_members.css">
    <script src="https://kit.fontawesome.com/f3d0c2ca4c.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Start-up Page</title>


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
        <div class="section">
            <h1>Add a Member to your team</h1>
            <form id="addMember" action="php_modules/addMember.php" method="post">
                <div class="input-group">
                    <label for="uEmail">Member's Email</label>
                    <input type="text" name="uEmail" id="uEmail" placeholder="Email">
                </div>
            </form>
            <button type="submit" form="addMember">Add Member</button>
        </div>
        <div class="categorii">
            <?php while ($row = mysqli_fetch_assoc($sql_result)) {
                if (!(empty($_GET['search']))) {
                    ?><a class="categorie" href="edit_user.php?user=<?php echo $row['ID']; ?>"><img id="poza-categorie"
                            src="images/users/<?php echo $row['Img']; ?>.png" />
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
                            src="images/users/<?php echo $row['Img']; ?>.png" />
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