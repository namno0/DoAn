<?php
    include('partials/menu.php');
?>

    <div class = "main_content">
        <div class="wrapper">
            <h1>Update Admin</h1>

            <br><br>

            <?php

                $id = $_GET['id'];
                //create sql query to get the details
                $sql = "SELECT * FROM db_admin WHERE id=$id";
                //execute the query
                $res = mysqli_query($conn, $sql);

                if($res == true){
                    //check the data is available or not
                    $count = mysqli_num_rows($res);
                    //check we have admin or not
                    if($count == 1){
                        echo " Admin Available";
                        $row = mysqli_fetch_assoc($res);

                        $full_name = $row['full_name'];
                        $username = $row['username'];
                    }else{
                        header('location:'. SITEURL. 'admin/manage_admin.php');
                    }
                }
            ?>

            <form action="" method="post">
                <table class="db_30">
                    <tr>
                        <td>Full name:</td>
                        <td>
                            <input type="text" name="full_name" value="<?php echo $full_name ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Username:</td>
                        <td>
                            <input type="text" name="username" value="<?php echo $username ?>">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update Admin" class="db_secondary">
                        </td>
                    </tr>

                </table>
            </form>
        </div>
    </div>

    <?php
    if(isset($_POST['submit'])){
        // echo "Button Click";
        //get all values from form to update
        echo $id = $_POST['id'];
        echo $full_name = $_POST['full_name'];
        echo $username = $_POST['username'];

        //create a SQL query to update admin
        $sql = "UPDATE db_admin SET full_name = '$full_name', username = '$username' WHERE id = '$id'";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //check the query executed successfull or not
        if($res == true){
            $_SESSION['update'] = "<div class = 'success'>Admin Update Successfully.</div>";
            header('location:'. SITEURL . 'admin/manage_admin.php');
        }
        else{
            $_SESSION['update'] = "<div class = 'error'>Failed to Update Admin.</div>";
            header('location:'. SITEURL . 'admin/manage_admin.php');
        }
    }
    ?>

<?php
    include('partials/footer.php');
?>