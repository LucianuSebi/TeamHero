<?php echo('')?>
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
                    <a href="# ">Feeds</a>
                </li>
                <li>
                    <a href="#  ">Your Account</a>
                </li>
                <li>
                    <a href="# ">Monitoring</a>
                </li>
                <li>
                    <a href="# ">Chats</a>
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
                    <a href="# ">Members</a>
                </li>
                <li>
                    <a href="# ">Projects</a>
                </li>
                <li>
                    <a href="# ">Organization</a>
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
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('.categoryHeader');

        buttons.forEach(function (button) {
            button.addEventListener('click', function () {
                const list = this.nextElementSibling;
                if(list.style.height === ''){
                    list.style.height = '0px';
                }
                else{
                    list.style.height = '';
                }
            });
        });
    });
</script>