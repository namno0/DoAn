<?php 
    include('partials\menu.php');
?>

<div class="main_content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        
        <br><br>
        <?php
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add']; //display session message
                    unset($_SESSION['add']); //remove session message
                }
            ?>

        <form action="" method="post">

            <table class="db_30">
                <tr>
                    <td>
                        <td>Full Name:</td>
                        <td><input type="text" name="full_name" placeholder="Enter Your Full Name"></td>
                    </td>
                </tr>

                <tr>
                    <td>
                        <td>Username:</td>
                        <td><input type="text" name="username" placeholder="Enter Your Username"></td>
                    </td>
                </tr>

                <tr>
                    <td>
                        <td>Password:</td>
                        <td><input type="password" name="password" placeholder="Enter Your Password"></td>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="submit" class="db_secondary">
                    </td>
                </tr>
            </table>

        </form>

    </div>
</div>

<?php 
    include('partials\footer.php');
?>

<?php
    // process the value from form and save it in database
    
    // check whether the submit button is clicked or not

    if(isset($_POST['submit'])){
        
        // 1. get the date from form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //password encryption with md5

        // 2. SQL query to save the data into database
        $sql = "INSERT INTO db_admin SET full_name = '$full_name', 
                                        username = '$username', 
                                        password = '$password'";

        //3. executing Query and save data into database
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        //4. check whether the (Query is executed) data is inserted or not and display appropriate massage
        
        if($res == true){
            // create a session variable to display message
            $_SESSION['add'] = "<div class='success'>Admin Added Succesfully</div>";
            //redict page
            header("location:". SITEURL. 'admin/manage_admin.php');
        }
        else{
            $_SESSION['add'] = "<div class='error'>Failed To Admin Added</div>";
            header("location:". SITEURL. 'admin/add_admin.php');
            echo "Faile to Insert Data";
        }
    }

?>