<?php session_start();
error_reporting(E_ERROR | E_PARSE);
include "db_conn.php";
if ($_SESSION['auth'] != TRUE) {
    header("location: .index.php");
    exit();
}
$search = mysqli_real_escape_string($conn, $_GET['search']);
$org = $_SESSION['org']['id'];
if (!(empty ($_GET['search']))) {
    $sql = "SELECT * FROM users WHERE FName like '%$search%' OR LName like '%$search%' AND Org= '$org' AND Verified = '1'";
    $sql_result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($sql_result);
} else
    $sql = "SELECT * FROM users WHERE org = '$org' AND Verified ='1'";
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
    <?php include ('includes/menu.php') ?>

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
                if (!(empty ($_GET['search']))) {
                    ?><a class="categorie" href="edit_user.php?user=<?php echo $row['ID']; ?>"><img id="poza-categorie"
                            src="images/users/<?php echo $row['Img']; ?>.png" />
                        <p class="titlu-categorie">
                            <?php echo $row['FName'];
                            echo " " . $row['LName']; ?>
                        </p>
                        <p class="rank-categorie">
                            <?php $ranks = unserialize($row['Rank']);
                            foreach ($ranks as $rank) {
                                echo $rank . " ";
                            } ?>
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
                            <?php $ranks = unserialize($row['Rank']);
                            foreach ($ranks as $rank) {
                                echo $rank . " ";
                            } ?>
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