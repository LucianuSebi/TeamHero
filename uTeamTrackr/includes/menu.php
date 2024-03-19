<?php echo ('') ?>
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
                <a href="dashboard_skills.php">Skills</a>
            </li>
            <li>
                <a href="dashboard_projects.php">Projects</a>
            </li>
            <li>
                <a href="dashboard_stats.php">Statistics</a>
            </li>
        </ul>

    </div>

    <div class="category" style="padding-top:20px;border-bottom:0px;">

        <ul>
            <li>
                <a href="index.php#contact">Support</a>
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