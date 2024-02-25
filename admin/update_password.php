<?php include('partials/menu.php') ?>

    <div class="main_content">
        <div class="wrapper">
            <h1>Change Password</h1>
            <br><br>

            <?php
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                }
            ?>

            <form action="" method="post">
                <table class="db_30">
                    <tr>
                        <td>Current Password:</td>
                        <td>
                            <input type="password" name="current_password" placeholder="Old Password">
                        </td>
                    </tr>

                    <tr>
                        <td>New Password:</td>
                        <td>
                            <input type="password" name="new_password" placeholder="New Password">
                        </td>
                    </tr>

                    <tr>
                        <td>Confrm Password:</td>
                        <td>
                            <input type="password" name="confirm_password" placeholder="Confirm Password">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Change Password" class="db_secondary">
                        </td>
                    </tr>
                </table>
            </form>

        </div>
    </div>

<?php

    if(isset($_POST['submit'])){
        
        $id = $_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        $sql = "SELECT * FROM db_admin WHERE id = '$id' AND password = '$current_password'";

        $res = mysqli_query($conn, $sql);

        if($res == true){
            $count =  mysqli_num_rows($res);

            if($count == 1){
                
                //check the new password and confirm match or not
                if($new_password == $confirm_password){
                    //update password
                    $sql2 = "UPDATE db_admin SET password = '$new_password' WHERE id='$id'";

                    //execute the query
                    $res2 = mysqli_query($conn, $sql2);

                    //check the query executed successfull or not
                    if($res2 == true){
                        $_SESSION['change_pwd'] = "<div class = 'success';>Password Change Succesfully.</div>";
                        header('location:'. SITEURL. 'admin/manage_admin.php');
                    }
                }else{
                    $_SESSION['pwd_not_found'] = "<div class = 'error';>Password Did Not Match.</div>";
                    header('location:'. SITEURL. 'admin/manage_admin.php');
                }
            }else{
                $_SESSION['user_not_found'] = "<div class = 'error';>User Not Found.</div>";
                header('location:'. SITEURL. 'admin/manage_admin.php');
            }
        }
    }
?>

<?php include('partials/footer.php') ?>