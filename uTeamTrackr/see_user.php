<?php session_start();
error_reporting(E_ERROR | E_PARSE);
include "db_conn.php";
if ($_SESSION['auth'] != TRUE) {
    header("location: index.php");
    exit();
}
$id = mysqli_real_escape_string($conn, $_GET['user']);
$sql = "SELECT * FROM users WHERE ID = '$id'";
$sql_result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($sql_result);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/virtual-select.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dashboard_youraccount.css">
    <script src="https://kit.fontawesome.com/f3d0c2ca4c.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Start-up Page</title>


</head>


<body>
    <?php include ('includes/menu.php') ?>

    <div class="pageContent">
        <h1>My Profile</h1>
        <div class="section" style="height: 180px;flex-direction:row;">
            <div class="image-selector">
                <?php if (file_exists("images/users/" . $row['Img'] . ".png")) { ?>
                    <img src="images/users/<?php echo $row['Img']; ?>.png" alt="">
                <?php } else { ?>
                    <img src="images/users/default.png" alt="">
                <?php } ?>
            </div>
            <div class="general-info">
                <p>
                    <?php echo $row['FName'] . " " . $row['LName'] ?>
                </p>
            </div>

        </div>
        <div class="section">
            <h1>Skills</h1>
            <div class="section-container">

                <?php $skills = unserialize($row['Skills']);
                foreach ($skills as $skill) {
                    $sql = "SELECT * FROM skills WHERE ID = '$skill'";
                    $sql_result = mysqli_query($conn, $sql);
                    $rowSkill = mysqli_fetch_array($sql_result); ?>
                    <div class="skill">
                        <div class="skill-section">
                            <p>
                                Skill Name:
                                <?php echo $rowSkill['Name']; ?>
                            </p>
                        </div>
                        <div class="skill-section">
                            <p>
                                Endorsed by
                                <?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM endorsements WHERE Skill='$skill' AND Recipient = '$id'")); ?>
                                people
                            </p>
                        </div>
                        <div class="skill-section">
                            <p>
                                Verified:
                                <?php if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM verified_skills WHERE Skill='$skill' AND Recipient = '$id'")))
                                    echo "yes";
                                else
                                    echo "no"; ?>
                            </p>
                        </div>
                        <div class="skill-section">
                            <form id="<?php echo $skill . "endorse"; ?>" action="php_modules/change_account_settings.php"
                                method="post" style="width: 0px;height: 0px;">
                                <input type="hidden" name="action" value="endorseSkill">
                                <input type="hidden" name="skill" value="<?php echo $skill; ?>">
                                <input type="hidden" name="userID" value="<?php echo $id; ?>">
                            </form>
                            <button style="font-size: 20px;" type="submit" form="<?php echo $skill . "endorse"; ?>">Endorse
                                Skill</button>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>

</body>