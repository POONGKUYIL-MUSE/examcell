<?php
session_start();
require '../database/config.php';
include_once('../assets/tcpdf/tcpdf.php');

require '../assets/phpmailer/src/PHPMailer.php';
require '../assets/phpmailer/src/Exception.php';
require '../assets/phpmailer/src/SMTP.php';

if (isset($_POST['get_department_batches'])) {
    if (isset($_POST['deptid'])) {

        $deptid = $_POST['deptid'];
        $query = "SELECT * FROM tbl_batch WHERE dept='$deptid'";

        $batches = [];

        $query_run = mysqli_query($conn, $query);
        if (mysqli_num_rows($query_run) > 0) {
            foreach ($query_run as $batch) {
                $temp['batchid'] = $batch['id'];
                $temp['dept'] = $batch['dept'];
                $temp['batchyear'] = $batch['batchyear'];

                array_push($batches, $temp);
            }
        } else {
            echo $conn->error;
        }
        echo json_encode([
            "success" => true,
            "batches" => $batches
        ]);
    } else {
        echo json_encode([
            "success" => false
        ]);
    }
}

if (isset($_POST['check_email_exists'])) {
    $email = $_POST['email'];

    $query = "SELECT id, firstname, lastname FROM tbl_student WHERE email='$email' limit 1";
    $query_run = mysqli_query($conn, $query);
    if (mysqli_num_rows($query_run) > 0) {
        $row = mysqli_fetch_assoc($query_run);

        $random_pass_code = rand(100000,999999);
        $random_pass = md5($random_pass_code);

        $query = "UPDATE tbl_student SET pass_code='" . $random_pass . "' WHERE id='" . $row['id'] . "'";
        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
            $mail_content = '';
            $mail_content .= 'Hi '.$row['firstname'] . ' ' . $row['lastname'].'!<br>';
            $mail_content .= 'You have requested for password reset to Examcell Account.<br>';
            $mail_content .= 'To update your password use below code,<br>';
            $mail_content .= 'pass_code : ' . $random_pass_code;

            if (send_email($email, 'Password Reset Verification', $mail_content)) {
                echo json_encode([
                    "success" => true,
                    "student_id" => $row['id']
                ]);
            } else {
                echo json_encode([
                    "success" => false
                ]);
            }
        }
    } else {
        echo json_encode([
            "success" => false
        ]);
    }
}

/**
 * send_email function to send email notification
 * https://github.com/PHPMailer/PHPMailer
 */
function send_email($toEmail, $subject, $content, $attachment = []) {

    // PHPMailer Mail Configuration
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'ngpasc.examcell@gmail.com';   // From address
    $mail->Password = 'your_specific_password';   // App specific password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    
    // Set From Email Address
    $mail->setFrom('ngpasc.examcell@gmail.com');
    // Set To Email Address
    $mail->addAddress($toEmail);
    
    // Subject and Content of the Mail
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $content;

    if (count($attachment) != 0) {
        $mail->AddStringAttachment($attachment[1], $attachment[0], 'base64', 'application/pdf');
    }
    
    // Sending the email
    if ($mail->send()) {
        return true;
    } else {
        return false;
    }
}

if (isset($_POST['change_student_password'])) {
    $email = $_POST['email'];
    $pass_code = $_POST['pass_code'];
    $new_pass = $_POST['new_password'];

    $query = "SELECT id, pass_code FROM tbl_student WHERE email='$email' limit 1";
    $query_run = mysqli_query($conn, $query);
    if (mysqli_num_rows($query_run) > 0) {
        $row = mysqli_fetch_assoc($query_run);

        if (md5($pass_code) == $row['pass_code']) {
            $query = "UPDATE tbl_student SET password='" . md5($new_pass) . "' WHERE id='" . $row['id'] . "'";
            $query_run = mysqli_query($conn, $query);
            if ($query_run) {
                echo json_encode([
                    "success" => true,
                    "student_id" => $row['id']
                ]);
            }
        } else {
            echo json_encode([
                "success" => false
            ]);
        }
    } else {
        echo json_encode([
            "success" => false
        ]);
    }
}