<?php

    include('../config/constants.php');

    //1. get the id of admin to delete 
    $id = $_GET['id'];

    //2. create SQL Query to delete admin
    $sql = "DELETE FROM db_admin WHERE id=$id";

    $res = mysqli_query($conn, $sql);

    if ($res === true) {
        echo "Admin Deleted";
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";
        header('location:' . SITEURL . 'admin/manage_admin.php');
    } else {
        echo "Failed to Delete Admin";
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin. Please Try Later</div>";
        header('location:' . SITEURL . 'admin/manage_admin.php');
    }

?>


    <!-- //3. redicect to manage admin page with message (successs/error)
