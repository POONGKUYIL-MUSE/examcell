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

        $sql = "SELECT * FROM tbl_student WHERE email='$email' AND password='$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['password'] == $password) {
                $_SESSION['id'] = $row['id'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['firstname'] = $row['firstname'];
                $_SESSION['lastname'] = $row['lastname'];
                $_SESSION['student_department'] = $row['student_department'];
                $_SESSION['student_batch'] = $row['student_batch'];
                $_SESSION['student'] = 1;
                
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

if (isset($_POST['student_register'])) {
    $regno = mysqli_real_escape_string($conn, $_POST['regno']);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phonenumber = mysqli_real_escape_string($conn, $_POST['phonenumber']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $student_department = mysqli_real_escape_string($conn, $_POST['student_department']);
    $student_batch = mysqli_real_escape_string($conn, $_POST['student_batch']);

    $query = "INSERT INTO tbl_student (regno,firstname,lastname,email,phonenumber,password,student_department,student_batch,active,created_at,created_by,updated_at,updated_by) VALUES 
    ('$regno','$firstname','$lastname','$email','$phonenumber','$password','$student_department','$student_batch',1,NOW(),1,NOW(),1)";

    $query_run = mysqli_query($conn, $query);
    if ($query_run) {
        $_SESSION['message'] = "User Registered Successfully";
        header("Location: ../index.php");
        exit(0);
    } else {
        $_SESSION['message'] = "User Not Registered";
        header("Location: register.php");
        exit(0);
    }
}