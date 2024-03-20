<?php echo ('') ?>
<?php $rank = unserialize($_SESSION['user']['rank']);
$uID = $_SESSION['user']['id']; ?>
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
                <a href="# ">Your Project</a>
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
                <a href="dashboard_youraccount.php">Your Account</a>
            </li>
            <li>
                <a href="dashboard_colleagues.php">Colleagues</a>
            </li>
        </ul>

    </div>
    <?php if (in_array('admin', $rank) || in_array('projM', $rank) || in_array('deptM', $rank)) { ?>
        <div class="category">

            <div class="categoryHeader">
                <p>ADMINISTRATION</p>
                <i class="fa-solid fa-angle-up"></i>
            </div>

            <ul>
                <?php if (in_array('admin', $rank) || in_array('deptM', $rank)) { ?>
                    <li>
                        <a href="dashboard_members.php">Members</a>
                    </li>
                <?php } ?>
                <?php if (in_array('admin', $rank) || in_array('projM', $rank)) { ?>
                    <li>
                        <a href="dashboard_skills.php">Skills</a>
                    </li>
                <?php } ?>
                <?php if (in_array('admin', $rank) || in_array('deptM', $rank)) { ?>
                    <li>
                        <a href="dashboard_depts.php">Departaments</a>
                    </li>
                <?php } ?>
                <li>
                    <a href="dashboard_projects.php">Projects</a>
                </li>
                <li>
                    <a href="dashboard_stats.php">Statistics</a>
                </li>
            </ul>

        </div>
    <?php } ?>
    <?php if (in_array('admin', $rank) || in_array('deptM', $rank)) { ?>
        <div class="category">

            <div class="categoryHeader">
                <p>DEPARTAMENTS</p>
                <i class="fa-solid fa-angle-up"></i>
            </div>

            <ul>
                <?php

                $sql = "SELECT * FROM users WHERE ID='$uID'";
                $sqlResult = mysqli_query($conn, $sql);
                $drow = mysqli_fetch_array($sqlResult);
                $depts = unserialize($drow['Dept']);
                foreach ($depts as $dept) {
                    $sql = "SELECT * FROM departaments WHERE ID='$dept'";
                    $sqlResult = mysqli_query($conn, $sql);
                    $drow = mysqli_fetch_array($sqlResult);
                    ?>
                    <li>
                        <a href="dashboard_dept_settings.php?dept=<?php echo $dept; ?>">
                            <?php echo $drow['Name']; ?>
                        </a>
                    </li>
                <?php } ?>

            </ul>

        </div>
    <?php } ?>

    <div class="category" style="padding-top:20px;border-bottom:0px;">

        <ul>
            <li>
                <a href="index.php#contact">Support</a>
            </li>
            <li>
                <a href="php_modules/logout.php">Log Out</a>
            </li>
        </ul>

    </div>

</div>
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