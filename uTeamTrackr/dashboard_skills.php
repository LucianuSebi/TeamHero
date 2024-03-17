<?php session_start();
error_reporting(E_ERROR | E_PARSE);
include "db_conn.php";
$id = 12;//$_SESSION['user']['org'];
//CHANGE "12" TO $id TO DISABLE DEBUG
$sql = "SELECT * FROM organizations WHERE ID = '$id'";
$sql_result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($sql_result);
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
                    <a href="dashboard_members.php">Members</a>
                </li>
                <li>
                    <a href="dashboard_projects.php">Projects</a>
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
        <h1>Controll Panel for Skills</h1>
        <div class="section">
            <h1>Skills Used By Organization</h1>
            <div class="section-container">
                <div class="skills">
                    <?php $sql="SELECT * FROM skills WHERE Org = '$id' ORDER BY Name";
                            $sql_result=mysqli_query($conn,$sql);
                            while ($rowOrgSkills = mysqli_fetch_assoc($sql_result)){ ?>
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
                                    <?php $skillLike = '"'.$rowOrgSkills['ID'].'"';echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE Skills LIKE '%$skillLike%' AND Org = '$id'")); ?>
                                    people
                                </p>
                            </div>
                            <div class="skill-section">
                                <form id="<?php echo $rowOrgSkills['ID']; ?>" action="php_modules/manage_skills.php"
                                    method="post" style="width: 0px;height: 0px;"><input type="hidden" name="action"
                                        value="removeSkill"><input type="hidden" name="skill" value="<?php echo $rowOrgSkills['ID']; ?>">
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