<?php

session_start();
include "../database/config.php";

if (isset($_POST['email']) && isset($_POST['password'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    
    if (empty($email)) {
        $_SESSION['message'] = 'Email is required';
        header("Location: index.php");
    } else if (empty($password)) {
        $_SESSION['message'] = 'Password is required';
        header("Location: index.php");
    } else {
        // Hashing the password
        $password = md5($password);

        $sql = "SELECT * FROM tbl_staff WHERE email='$email' AND password='$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['password'] == $password) {
                $_SESSION['id'] = $row['id'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['firstname'] = $row['firstname'];
                $_SESSION['lastname'] = $row['lastname'];
                $_SESSION['admin'] = $row['admin'];
                
                header("Location: dashboard.php");
            } else {
                $_SESSION['message'] = 'Email or Password is incorrect';
                header("Location: index.php");
            }
        } else {
            $_SESSION['message'] = 'Email or Password is incorrect';
            header("Location: index.php");
        }
        
    }
    
} else {
    header("Location: index.php");
}