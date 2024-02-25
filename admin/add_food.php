<?php include('partials/menu.php') ?>

<div class="main_content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br><br>

        <?php

            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="post" enctype="multipart/form-data">
            <table class="db_30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Title Of The Food">
                    </td>
                </tr>

                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description Of Your Food"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">

                            <?php 
                            //create sql to display category from database
                            $sql = "SELECT * FROM db_category WHERE active='Yes'";

                            $res = mysqli_query($conn, $sql);

                            //count row to check we have category or not
                            $count = mysqli_num_rows($res);

                            //if count is greater than zero, we have category else we don't have category
                            if($count>0){
                                
                                while($row = mysqli_fetch_assoc($res)){
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    ?>

                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                    <?php
                                }
                            }else{
                                ?>
                                    <option value="0">No Category Found</option>
                                <?php
                            }   
                            ?>

                        </select>
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
                        <input type="submit" name="submit" value="Add Food" class="db_secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php

            if(isset($_POST['submit'])){
                
                //get data from form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                //check radio button for featured and active are check or not
                if(isset($_POST['featured'])){
                    $featured = $_POST['featured'];
                }else{
                    $featured = "No"; //setting default value
                }

                if(isset($_POST['active'])){
                    $active = $_POST['active'];
                }else{
                    $active = "No"; //setting default value
                }

                //check the image is clicked or not and upload the image only if the image is selected
                if(isset($_FILES['image']['name'])){
                    //to upload image we need image name, source path and destination path
                    $image_name = $_FILES['image']['name'];
                    
                    if($image_name != ""){

                        //auto rename image
                        //get the extenstion oof our image (img, png, gif, etc) e.g "special.food1.jpg"
                        $ext = end(explode('.', $image_name));

                        //rename image
                        $image_name = "Food_Name_". rand(000, 999). '.'. $ext; //e.g Food_Category_123.jpg

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/food/". $image_name;

                        //upload thhe image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //check the image is upload or not
                        //and if the image is not uploaded then we will stop te process ad redicted with error message
                        if($upload == false){
                            $_SESSION['upload'] = "<div class = 'error'>Failed to Upload Image.</div>";
                            header('location:'. SITEURL. 'admin/add_food.php');

                            die();
                        }

                    }

                }else{
                    //don't upload image and set the image_name value as blank
                    $image_name = "";
                }

                //insert into database
                $sql2 = "INSERT INTO db_food SET
                        title = '$title',
                        description = '$description',
                        price = $price,
                        image_name = '$image_name',
                        category_id = '$category',
                        featured = '$featured',
                        active = '$active'";

                $res2 = mysqli_query($conn, $sql2);

                if($res2 == true){
                    $_SESSION['add'] = "<div class = 'success'>Food Add Successfully.</div>";
                    header('location:'. SITEURL. 'admin/manage_food.php');
                }else{
                    $_SESSION['add'] = "<div class = 'error'>Failed To Add Food.</div>";
                    header('location:'. SITEURL. 'admin/add_food.php');
                }
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php') ?>