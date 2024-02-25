<?php 
   
    include('../config/constants.php');


    if(isset($_GET['id']) && isset($_GET['image_name'])){

        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //check image is available or not and delete only if available
        if($image_name != ""){

            //get image path
            $path = "../images/food/". $image_name;

            //remove image file from folder
            $remove = unlink($path);

            //check the image is remove or not
            if($remove == false){

                $_SESSION['upload'] = "<div class = 'error'>Failed To Remove Image File.</div>";
                header('location:'. SITEURL. 'admin/manage_food.php');
                die();
            }
        }

        $sql = "DELETE FROM db_food WHERE id=$id";

        $res = mysqli_query($conn, $sql);

        if($res == true){

            $_SESSION['delete'] = "<div class = 'success'>Food Delete Successfully.</div>";
            header('location:'. SITEURL. 'admin/manage_food.php');
        }else{

            $_SESSION['delete'] = "<div class = 'error'>Failed To Delete Food.</div>";
            header('location:'. SITEURL. 'admin/manage_food.php');

        }
        
    }else{
        $_SESSION['authorize'] = "<div class = 'error'>Unauthorized Access.</div>";
        header('location:'. SITEURL. 'admin/manage_food.php');
    }

?>