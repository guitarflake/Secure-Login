<?php
set_include_path('/');
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
 
if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Homework app login system</title>
        <link rel="stylesheet" href="styles/main.css" />
        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script> 
    </head>
    <body>
        <?php
            if (isset($_GET['error'])) {
                echo '<p class="error"> Error logging in!</p>';
            }

            echo "<script>console.log('uid session var: " . $_SESSION["user_id"] . ");</script>";
            echo "<script>console.log('username session var: " . $_SESSION["username"] . ");</script>";
            echo "<script>console.log('login str sessino var: " . $_SESSION["login_string"] . ");</script>"; 
        ?>
        <form action="includes/process_login.php" method="post" name="login_form">
            Email: <input type="text" name="email" />
            Password: <input type="password" 
                             name="password" 
                             id="password"/>
            <input type="button" 
                   value="Login" 
                   onclick="formhash(this.form, this.form.password);" /> 
        </form>

        <?php
            if (login_check($mysqli) == true) {
                            echo '<p>Currently logged ' . $logged . ' as ' . htmlentities($_SESSION['username']) . '.</p>';
                            echo '<p>Enter <a href="user_home.php">user home page</a></p>';
 
                echo '<p>Do you want to change user? <a href="includes/logout.php">Log out</a>.</p>';
            } else {
                            echo '<p>Currently logged ' . $logged . '.</p>';
                            echo "<p>If you don't have a login, please <a href='register.php'>register</a>.</p>";
                    }
        ?>

    </body>
</html>