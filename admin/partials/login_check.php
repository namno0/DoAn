<?php 

    //Accept control
    //check the user is logged in or ot
    if(!isset($_SESSION['user'])){ //if user session is not set
        //user is not login
        //redict to login page with messege
        $_SESSION['no_login_messege'] = "<div class = 'error text_center'>Please login to access Admin Panel.</div>";
        header('location:'. SITEURL. 'admin/login.php');
    }

?>