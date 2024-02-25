<?php include('partials/menu.php') ?>

    <div class="main_content">
        <div class="wrapper">
            <h1>Add Category</h1>
            <br><br>

            <?php 

                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                if(isset($_SESSION['upload'])){
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
            ?>
            <br><br>

            <form action="" method="post" enctype="multipart/form-data">
                <table class="db_30">
                    <tr>
                        <td>Title:</td>
                        <td><input type="text" name="title" placeholder="Category Title"></td>
                    </tr>

                    <tr>
                        <td>Select Image:</td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>

                    <tr>
                        <td>Featured:</td>
                        <td>
                            <input type="radio" name="featured" value="Yes"> Yes
                            <input type="radio" name="featured" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td>Active:</td>
                        <td>
                            <input type="radio" name="active" value="Yes"> Yes
                            <input type="radio" name="active" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Category" class="db_secondary">
                        </td>
                    </tr>
                </table>
            </form>

            <?php 

                if(isset($_POST['submit'])){
                    
                    $title = $_POST['title'];

                    //fo radio input, we need to check the button is selected or not
                    if(isset($_POST['featured'])){
                        $featured = $_POST['featured'];
                    }else{
                        $featured = "No";
                    }

                    if(isset($_POST['active'])){
                        $active = $_POST['active'];
                    }else{
                        $active = "No";
                    }

                    //check the image is selected or not and set the value for image name
                    // print_r($_FILES['image']);

                    // die();

                    if(isset($_FILES['image']['name'])){
                        //to upload image we need image name, source path and destination path
                        $image_name = $_FILES['image']['name'];
                        
                        if($image_name != ""){

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
                                header('location:'. SITEURL. 'admin/add_category.php');

                                die();
                            }

                        }

                    }else{
                        //don't upload image and set the image_name value as blank
                        $image_name = "";
                    }

                    $sql = "INSERT INTO db_category SET
                            title = '$title',
                            image_name = '$image_name',
                            featured = '$featured',
                            active = '$active'";
                    
                    $res = mysqli_query($conn, $sql);

                    if($res == true){
                        $_SESSION['add'] = "<div class = 'success'>Category Add Successfull.</div>";
                        header('location:'. SITEURL. 'admin/manage_category.php');
                    }else{
                        $_SESSION['add'] = "<div class = 'error'>Failed To Add Category.</div>";
                        header('location:'. SITEURL. 'admin/add_category.php');
                    }
                }
            ?>
        </div>
    </div>

<?php include('partials/footer.php') ?>