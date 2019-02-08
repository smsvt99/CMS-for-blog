<?php
session_start(); 
include 'db.php';
include '../admin/functions.php';
if(isset($_POST['login'])){

    $username = escape($_POST['username']);
    $password = escape($_POST['password']);

    $query = "SELECT user_name, user_role, user_email, user_id, user_password FROM users WHERE user_name = ? ";
    
    $stmt = mysqli_prepare($connection, $query);
    
    mysqli_stmt_bind_param($stmt, "s", $username);
    
    mysqli_stmt_execute($stmt);
    
    mysqli_stmt_bind_result($stmt, $user_name, $user_role, $user_email, $user_id, $user_password);
    
    while(mysqli_stmt_fetch($stmt)){

        $password = crypt($password, $user_password);

        if ($user_password == $password){
            ob_start();
            header("Location: ../admin/");
            $_SESSION['username'] = $username;
            $_SESSION['user_role'] = $user_role;
            $_SESSION['user_email'] = $user_email; 
            $_SESSION['user_id'] = $user_id;
            exit();            
        } else {
            ob_start();
            header("Location: ../index.php?login=failed");
            exit();
        }
    }
    ob_start();
    header("Location: ../index.php?login=failed");
    exit();
}
?>