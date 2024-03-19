<?php session_start();
error_reporting(E_ERROR | E_PARSE);
include "db_conn.php";
include "php_modules/roles.php";
if ($_SESSION['auth'] != TRUE) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}
$search = mysqli_real_escape_string($conn, $_GET['search']);
$org = $_SESSION['organization']['uOrg'];
if (!(empty ($_GET['search']))) {
    $sql = "SELECT * FROM projects WHERE Org= '$org'";
    $sql_result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($sql_result);
} else
    $sql = "SELECT * FROM projects WHERE org = '12'";
$sql_result = mysqli_query($conn, $sql);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dashboard_projects.css">
    <script src="https://kit.fontawesome.com/f3d0c2ca4c.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Start-up Page</title>

</head>


<body>
    <?php include ('includes/menu.php') ?>

    <div class="pageContent">
        <div class="categorii">
            <?php while ($row = mysqli_fetch_assoc($sql_result)) {


                ?><a class="categorie" href="edit_projects.php?project=<?php echo $row['ID']; ?>"><img
                        id="poza-categorie" src="images/projects/<?php echo $row['ID']; ?>.png" />
                    <p class="titlu-categorie">
                        <?php echo $row['Name']; ?>
                    </p>
                    <p class="manage-categorie">
                        MANAGE
                    </p>
                </a>
                <?php
            } ?>
        </div>
    </div>

</body>