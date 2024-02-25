<?php include('partials/menu.php'); ?>

<div class="main_content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>

        <?php 

            //check id is check or not
            if(isset($_GET['id'])){
                
                $id = $_GET['id'];

                $sql = "SELECT * FROM db_category WHERE id=$id";

                $res = mysqli_query($conn, $sql);

                //count the row to check the id is valid or not
                $count = mysqli_num_rows($res);

                if($count == 1){

                    //get all the data
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }else{
                    $_SESSION['no_category_found'] = "<div class = 'error'>Category Not Found</div>";
                    header('location:'. SITEURL. 'admin/manage_category.php');
                }
            
            }else{
                header('location:'. SITEURL. 'admin/manage_category.php');
            }
        ?>

        <form action="" method="post" enctype="multipart/form-data">
            <table class="db_30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php 
                            if($current_image != ""){

                                ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                                <?php
                            }else{
                                echo "<div class = 'error'>Image Not Add</div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured == "Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if($featured == "No"){echo "checked";} ?>  type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active == "Yes"){echo "checked";} ?>  type="radio" name="active" value="Yes"> Yes
                        <input <?php if($active == "No"){echo "checked";} ?>  type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="db_secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php

            if(isset($_POST['submit'])){
                
                //get all value from form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //check the image is selected or not
                if(isset($_FILES['image']['name'])){

                    //get image details
                    $image_name = $_FILES['image']['name'];

                    //check image is available or not
                    if($image_name != ""){

                        //upload the image
                        //auto rename image
                        //get the extenstion oof our image (img, png, gif, etc) e.g "special.food1.jpg"
                        $ext = end(explode('.', $image_name));

                        //rename image
                        $image_name = "Food_Category_". rand(000, 999). '.'. $ext; //e.g Food_Category_123.jpg

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/". $image_name;

                        //upload thhe image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //check the image is upload or not
                        //and if the image is not uploaded then we will stop te process ad redicted with error message
                        if($upload == false){
                            $_SESSION['upload'] = "<div class = 'error'>Failed to Upload Image.</div>";
                            header('location:'. SITEURL. 'admin/manage_category.php');

                            die();
                        }

                        //remove current image if available
                        if($current_image != ""){

                            $remove_path = "../images/category/". $current_image;

                            $remove = unlink($remove_path);

                            //check the image is removed or not
                            //if falied to remove then displayed the message and stop the process
                            if($remove == false){

                                //Failed to remove image
                                $_SESSION['failed_remove'] = "<div class = 'error'>Failed To Remove Current Image.</div>";
                                header('location:'. SITEURL. 'admin/manage_category.php');
                                die();
                            }
                        }
                        
                    }else{
                        $image_name = $current_image;
                    }
                }else{
                    $image_name = $current_image;
                }

                //update database
                $sql2 = "UPDATE db_category SET
                        title = '$title',
                        image_name = '$image_name',
                        featured = '$featured',
                        active = '$active'
                        WHERE id = $id";

                $res2 = mysqli_query($conn, $sql2);

                //check executed or not
                if($res2 == true){
                    $_SESSION['update'] = "<div class = 'success'>Category Update Successfull.</div>";
                    header('location:'. SITEURL. 'admin/manage_category.php');
                }else{
                    $_SESSION['update'] = "<div class = 'error'>Failed To Update Category.</div>";
                    header('location:'. SITEURL. 'admin/manage_category.php');
                }
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>