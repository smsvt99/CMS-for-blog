<?php
session_start(); 
include 'db.php';
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM users WHERE user_name = '{$username}'";
    $find_user = mysqli_query($connection, $query);

    if(!$find_user){
        die('QUERY FAILED: ' . mysqli_error($connection));
    }
    while($row = mysqli_fetch_assoc($find_user)){
        if ($row['user_password'] === $password && $row['user_name'] === $username){
            $_SESSION['username'] = $username;
            $_SESSION['first_name'] = $row['user_first_name'];
            $_SESSION['last_name'] = $row['user_last_name'];
            $_SESSION['user_role'] = $row['user_role'];
            $_SESSION['user_id'] = $row['user_id'];



            header("Location: ../admin/");
        } else {
            header("Location: ../index.php?login=failed");
        }
    }
}

?>