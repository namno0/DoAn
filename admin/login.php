<?php include('../config/constants.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Food Order System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    
    <div class="login">
        <h1 class="text_center">Login</h1>
        <br><br>
        <?php 
            if(isset($_SESSION['login'])){
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            if(isset($_SESSION['no_login_messege'])){
                echo $_SESSION['no_login_messege'];
                unset($_SESSION['no_login_messege']);
            }
        ?>
        <br><br>

        <!-- Login form starts here -->
        <form action="" method="post" class="text_center">
            Username: <br>
            <input type="text" name="username" placeholder="Enter Username"><br><br>
            Password: <br>
            <input type="password" name="password" placeholder="Enter Password"><br><br>
            <input type="submit" name="submit" value="Login" class="db_primary">
        </form>

        <p class="text_center">Created By - <a href="www.Npnzero.com">Npnzero</a></p>
    </div>
</body>
</html>

<?php

    if(isset($_POST['submit'])){

        // $username = $_POST['username'];
        $username = mysqli_real_escape_string($conn, $_POST['username']);

        // $password = md5($_POST['password']);
        $raw_password = md5($_POST['password']);
        $password = mysqli_real_escape_string($conn, $raw_password);

        //sql to check the username and password exists or not 
        $sql = "SELECT * FROM db_admin WHERE username = '$username' AND password = '$password'";

        //executed the query
        $res = mysqli_query($conn, $sql);

        //count row to check the user exists or not
        $count = mysqli_num_rows($res);

        if($count == 1){

            $_SESSION['login'] = "<div class = 'success'>Login Successful.</div>";
            $_SESSION['user'] = $username;

            header('location:'. SITEURL. 'admin/');
        }else{

            $_SESSION['login'] = "<div class = 'error text_center'>Username or Password did not match.</div>";
            header('location:'. SITEURL. 'admin/login.php');
        }
    }
?>