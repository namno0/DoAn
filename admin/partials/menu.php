<?php 
    include('../config/constants.php'); 
    include('login_check.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Food Order Website - Home Page</title>
</head>
<body>
    <!-- Menu section starts -->
    <div class="menu text_center">
        <div class="wrapper">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="manage_admin.php">Admin</a></li>
                <li><a href="manage_category.php">Category</a></li>
                <li><a href="manage_food.php">Food</a></li>
                <li><a href="manage_order.php">Order</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>    
    </div>
    <!-- Menu section ends -->