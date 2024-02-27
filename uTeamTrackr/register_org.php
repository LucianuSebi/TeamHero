<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/f3d0c2ca4c.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formular</title>
    
</head>
<body>
    
    <form action="php_modules/register_org.php" method="post">
    <h2>Administrator Information</h2>
        <!-- Administrator Information -->
        <div class="input-group">

            <div class="input-field">
                <i class="fa-solid fa-phone fa-lg"></i>
                <input type= "text" name="fName" placeholder="First Name">
            </div>
        
            <div class="input-field">
                <i class="fa-solid fa-phone fa-lg"></i>
                <input type= "text" name="lName" placeholder="Last Name">
            </div>

            <div class="input-field">
                <i class="fa-solid fa-phone fa-lg"></i>
                <input type= "text" name="uPhone" placeholder="Phone">
            </div>

            <div class="input-field">
                <i class="fa-solid fa-phone fa-lg"></i>
                <input type= "text" name="uEmail" placeholder="Email">
            </div>

            <div class="input-field">
                <i class="fa-solid fa-phone fa-lg"></i>
                <input type= "text" name="uPass" placeholder="Password">
            </div>

            <div class="input-field">
                <i class="fa-solid fa-phone fa-lg"></i>
                <input type= "text" name="uRePass" placeholder="Repeat Password">

            </div>

        </div>


        <!-- Organisation Information -->
        <h2>Organisation Information</h2>
        <div class="input-group">

            <div class="input-field">
                <i class="fa-solid fa-phone fa-lg"></i>
                <input type= "text" name="cName" placeholder="Company Name">
            </div>

            <div class="input-field">
                <i class="fa-solid fa-phone fa-lg"></i>
                <input type= "text" name="cPhone" placeholder="Company Phone">
            </div>

            <div class="input-field">
                <i class="fa-solid fa-phone fa-lg"></i>
                <input type= "text" name="cEmail" placeholder="Company Email">
            </div>

            <div class="input-field">
                <i class="fa-solid fa-phone fa-lg"></i>
                <input type= "text" name="cAdress" placeholder= "Company Address">
            </div>
        </div>
        
        <button type="submit">Submit</button>
    </form>
</body>
</html>