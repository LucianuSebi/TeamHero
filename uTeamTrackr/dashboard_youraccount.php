<?php session_start();
error_reporting(E_ERROR | E_PARSE);
include "db_conn.php";
$id = $_SESSION['user']['id'];
$sql = "SELECT * FROM users WHERE ID = '25'";
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
        <h1>My Profile</h1>
        <div class="section" style="height: 80px;">
            <form id="personal-information" style="height: 300px;" action="">
                <img src="images/users/<?php echo $row['ID']; ?>.png" alt="">
                <div class="general-info">

                </div>
            </form>
            <button type="submit" form="personal-information">Save Changes</button>

        </div>
        <div class="section">
            <h1>Personal information</h1>
            <form id="personal-information" style="height: 300px;" action="php_modules/change_account_settings.php?action=PersonalInformation">
                <div class="input-group">
                    <label for="fname">First Name</label>
                    <input type="text" id="fname" name="fname" placeholder="<?php echo $row['FName']; ?>">
                </div>
                <div class="input-group">
                    <label for="lname">Last Name</label>
                    <input type="text" id="lname" name="lname" placeholder="<?php echo $row['LName']; ?>">
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="<?php echo $row['Email']; ?>">
                </div>
                <div class="input-group">
                    <label for="phone">Phone</label>
                    <input type="phone" id="phone" name="phone" placeholder="<?php echo $row['Phone']; ?>">
                </div>
                <div class="input-group">
                    <label for="bio">Biograpy</label>
                    <textarea type="text" id="bio" name="bio" rows="5" cols="50"><?php echo $row['Bio']; ?></textarea>
                </div>
            </form>
            <button type="submit" form="personal-information">Save Changes</button>

        </div>
        <div class="section">
            <h1>Adress</h1>
            <form id="adress-information" style="height: 200px;" action="">
                <div class="input-group">
                    <label for="country">Country</label>
                    <input type="text" id="country" name="country" placeholder="<?php echo $row['Country']; ?>">
                </div>
                <div class="input-group">
                    <label for="county">County</label>
                    <input type="text" id="county" name="county" placeholder="<?php echo $row['County']; ?>">
                </div>
                <div class="input-group">
                    <label for="city">City</label>
                    <input type="text" id="city" name="city" placeholder="<?php echo $row['City']; ?>">
                </div>
                <div class="input-group">
                    <label for="postalCode">Postal Code</label>
                    <input type="text" id="postalCode" name="postalCode"
                        placeholder="<?php echo $row['PostalCode']; ?>">
                </div>
            </form>
            <button type="submit" form="adress-information">Save Changes</button>

        </div>
        <div class="section">
            <h1>Skills</h1>
            <div class="section-container">
                <div class="skills">
                    <h1>Active skills</h1>
                    <div class="skill">
                        <div class="skill-section">
                            <p>
                                Skill Name: PHP
                            </p>
                        </div>
                        <div class="skill-section">
                            <p>
                                Endorsed by 6 people
                            </p>
                        </div>
                        <div class="skill-section">
                            <p>
                                Verified: no
                            </p>
                        </div>
                        <div class="skill-section">
                            <form id="" action="" style="width: 0px;height: 0px;"></form>
                            <button type="submit" form="">Delete Skill</button>
                        </div>
                    </div>
                </div>
                <div class="add-skills">
                    <h1>Add Skills</h1>
                    <form id="skill-information" style="height: auto;min-height: 300px;" action="">
                        <select id="multi_option" multiple name="skills[]" placeholder="Add Skills"
                            data-silent-initial-value-set="false">
                            <option value="1">HTML</option>
                            <option value="2">CSS</option>
                            <option value="3">JavaScript</option>
                            <option value="4">Python</option>
                            <option value="5">JAVA</option>
                            <option value="6">PHP</option>
                        </select>
                    </form>
                    <button type="submit" form="skill-information">Save Changes</button>
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
<script type="text/javascript" src="js/virtual-select.min.js"></script>
<script type="text/javascript">
    VirtualSelect.init({
        ele: '#multi_option'
    });
</script>