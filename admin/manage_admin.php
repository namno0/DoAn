<?php 
    include('partials\menu.php');
?>
    <!-- Main content section starts -->
    <div class="main_content">
        <div class="wrapper">
            <h1>Manage Admin</h1> 

            <br>

            <?php
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add']; //display session message
                    unset($_SESSION['add']); //remove session message
                }
                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                if(isset($_SESSION['user_not_found'])){
                    echo $_SESSION['user_not_found'];
                    unset($_SESSION['user_not_found']);
                }
                if(isset($_SESSION['pwd_not_found'])){
                    echo $_SESSION['pwd_not_found'];
                    unset($_SESSION['pwd_not_found']);
                }
                if(isset($_SESSION['change_pwd'])){
                    echo $_SESSION['change_pwd'];
                    unset($_SESSION['change_pwd']);
                }
            ?>
            <br><br><br>

            <!-- button to add admin -->
            <a href="add_admin.php" class="db_primary">Add Admin</a>
            
            <br><br><br>
            <table class="db_full">
                <tr>
                    <th>S.N.</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>

                <?php
                    $sql = "SELECT * FROM db_admin";
                    //execute the query
                    $res = mysqli_query($conn, $sql);

                    //check the whether the query is executed or not
                    if($res == true){
                        //count row to check whether we have data in database or not
                        $count = mysqli_num_rows($res); //function to get all the row in database
                        $sn = 1;

                        if($count > 0){
                            while($rows=mysqli_fetch_assoc($res)){

                                //get data
                                $id = $rows['id'];
                                $full_name = $rows['full_name'];
                                $username = $rows['username'];

                                //display data
                                ?>

                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $full_name; ?></td>
                                    <td><?php echo $username; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update_password.php?id=<?php echo $id; ?>" class="db_primary">Change Password</a>
                                        <a href="<?php echo SITEURL; ?>admin/update_admin.php?id=<?php echo $id; ?>" class="db_secondary">Update Admin</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete_admin.php?id=<?php echo $id; ?>" class="db_danger">Delete Admin</a>
                                    </td>
                                </tr>
                                
                                <?php
                            }
                        }
                    }
                ?>

                
            </table>

        </div>
    </div>
    <!-- Main content section ends -->
    
<?php 
    include('partials\footer.php');
?>