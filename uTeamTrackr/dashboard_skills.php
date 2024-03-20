<?php session_start();
error_reporting(E_ERROR | E_PARSE);
include "db_conn.php";
if ($_SESSION['auth'] != TRUE || $_SESSION['user']['rank'] == 'user') {
    header("location: index.php");
    exit();
}
$id = $_SESSION['org']['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/style_skills.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/f3d0c2ca4c.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Start-up Page</title>

</head>


<body>
    <?php include ('includes/menu.php') ?>
    <div class="pageContent">
        <h1>Controll Panel for Skills</h1>
        <div class="section">
            <h1>Skills Used By Organization</h1>
            <div class="add-skill">
                <h2>Add a Skill</h2>
                <form id="add-skill" action="php_modules/manage_skills.php" method="post" style="">
                    <input type="hidden" name="action" value="addSkill">
                    <input type="text" name="skill" placeholder="Skill Name">
                </form>
                <button type="submit" form="add-skill">Add Skill</button>
            </div>
            <div class="section-container">
                <div class="skills">
                    <?php $sql = "SELECT * FROM skills WHERE Org = '$id' ORDER BY Name";
                    $sql_result = mysqli_query($conn, $sql);
                    while ($rowOrgSkills = mysqli_fetch_assoc($sql_result)) { ?>
                        <div class="skill">
                            <div class="skill-section">
                                <p>
                                    Skill ID:
                                    <?php echo $rowOrgSkills['ID']; ?>
                                </p>
                            </div>
                            <div class="skill-section">
                                <p>
                                    Skill Name:
                                    <?php echo $rowOrgSkills['Name']; ?>
                                </p>
                            </div>
                            <div class="skill-section">
                                <p>
                                    Selected by
                                    <?php $skillLike = '"' . $rowOrgSkills['ID'] . '"';
                                    echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE Skills LIKE '%$skillLike%' AND Org = '$id'")); ?>
                                    people
                                </p>
                            </div>
                            <div class="skill-section">
                                <form id="<?php echo $rowOrgSkills['ID']; ?>" action="php_modules/manage_skills.php"
                                    method="post" style="width: 0px;height: 0px;"><input type="hidden" name="action"
                                        value="removeSkill"><input type="hidden" name="skill"
                                        value="<?php echo $rowOrgSkills['ID']; ?>">
                                </form>
                                <button type="submit" form="<?php echo $rowOrgSkills['ID']; ?>">Delete Skill</button>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</body>