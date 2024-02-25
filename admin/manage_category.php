<?php 
    include('partials\menu.php');
?>

<div class="main_content">
    <div class="wrapper">
        <h1>Manage Category</h1>

        <br><br>

        <?php 

            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['remove'])){
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }
            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['no_category_found'])){
                echo $_SESSION['no_category_found'];
                unset($_SESSION['no_category_found']);
            }
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if(isset($_SESSION['failed_remove'])){
                echo $_SESSION['failed_remove'];
                unset($_SESSION['failed_remove']);
            }
        ?>
        <br><br>
            <!-- button to add admin -->
            <a href="<?php echo SITEURL; ?>admin/add_category.php" class="db_primary">Add Category</a>
            
            <br><br><br>
            <table class="db_full">
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

                <?php 

                    $sql = "SELECT * FROM db_category";

                    $res = mysqli_query($conn, $sql);

                    $count = mysqli_num_rows($res);

                    $sn = 1;

                    if($count > 0){

                        while($row = mysqli_fetch_assoc($res)){
                            $id = $row['id'];
                            $title = $row['title'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];

                            ?>

                                <tr>
                                    <td><?php echo $sn++ ?></td>
                                    <td><?php echo $title ?></td>

                                    <td>
                                        <?php 
                                            //check image name is avalable or not
                                            if($image_name!=""){
                                                //display the image
                                                ?>
                                                <img src="<?php echo SITEURL ?>images/category/<?php echo $image_name ?>" width="100px">
                                                <?php
                                            }else{
                                                echo "<div class = 'error'>Image Not Added</div>";
                                            }
                                        ?>
                                    </td>

                                    <td><?php echo $featured ?></td>
                                    <td><?php echo $active ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update_category.php?id=<?php echo $id; ?>" class="db_secondary">Update Category</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete_category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="db_danger">Delete Category</a>
                                    </td>
                                </tr>
                            <?php
                        }
                    }else{
                        //display massage inside the table
                        ?>
                            <tr>
                                <td colspan="6"><div class="error">No Category Added</div></td>
                            </tr>
                        <?php
                    }

                ?>

            </table>
    </div>
</div>

<?php 
    include('partials\footer.php');
?>