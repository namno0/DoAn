<?php 
    include('../config/constants.php');

    //check the id and image_name value is set or not
    if (isset($_GET['id']) && isset($_GET['image_name'])) {
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];
      
        // Remove physical image file if exists
        if ($image_name != "") {
          $path = "../images/category/" . $image_name;
          $remove = unlink($path);

            //if failed to remove image then add error message
            if($remove == false){
                $_SESSION['remove'] = "<div class = 'error'>Failed to Remove Category Image.</div>";
                header('location:'. SITEURL. 'admin/manage_category.php');
                die();
            }
        }

        $sql = "DELETE FROM db_category WHERE id=$id";

        $res = mysqli_query($conn, $sql);

        if($res == true){

            $_SESSION['delete'] = "<div class = 'success'>Category Delete Successfully.</div>";
            header('location:'. SITEURL. 'admin/manage_category.php');
        }else{

            $_SESSION['delete'] = "<div class = 'error'>Failed To Delete Category.</div>";
            header('location:'. SITEURL. 'admin/manage_category.php');
        }

    }else{
        header('location:'. SITEURL. 'admin/manage_category.php');
    }
?>