<?php
session_start();
require '../database/config.php';
include_once('../assets/tcpdf/tcpdf.php');

require '../assets/phpmailer/src/PHPMailer.php';
require '../assets/phpmailer/src/Exception.php';
require '../assets/phpmailer/src/SMTP.php';

// current date
$today = date('Y-m-d');

$email_service = [];

$query = "SELECT * FROM tbl_email_service WHERE status=0 OR status=1 ORDER BY status DESC LIMIT 1";
$query_run = mysqli_query($conn, $query);
if (mysqli_num_rows($query_run) > 0) {
    foreach ($query_run as $service) {
        $email_service['id'] = $service['id'];
        $email_service['email'] = $service['email'];
        $properties = json_decode($service['properties']);
        $email_service['email_username'] = $properties->email_username;
        $email_service['email_host'] = $properties->email_host;
        $email_service['email_secure'] = $properties->email_secure;
        $email_service['email_port'] = $properties->email_port;
        $email_service['password'] = $properties->password;
        $email_service['status'] = $service['status'];
    }
}

// Status Check for tbl_exams status field
$query = "SELECT * FROM tbl_exams WHERE tbl_exams.exam_date='$today' AND status != 2";
$query_run = mysqli_query($conn, $query);
if (mysqli_num_rows($query_run) > 0) {
    foreach ($query_run as $exam) {
        $query_update = "UPDATE tbl_exams SET status=2 WHERE id='" . $exam['id'] . "'";
        $query_run = mysqli_query($conn, $query_update);
    }
}

// Status Check for tbl_exams status field
$query = "SELECT * FROM tbl_exams WHERE tbl_exams.exam_date<'$today' AND status != 3";
$query_run = mysqli_query($conn, $query);
if (mysqli_num_rows($query_run) > 0) {
    foreach ($query_run as $exam) {
        $query_update = "UPDATE tbl_exams SET status=3 WHERE id='" . $exam['id'] . "'";
        $query_run = mysqli_query($conn, $query_update);
    }
}

// Mail Staff two day before the exam
$query = "SELECT tbl_halls.id as hall_id, tbl_halls.*, tbl_room.id as room_id, tbl_room.*, tbl_department.deptname, tbl_block.block FROM tbl_halls INNER JOIN tbl_room ON tbl_room.id=tbl_halls.room INNER JOIN tbl_department ON tbl_department.id=tbl_room.dept INNER JOIN tbl_block ON tbl_block.id=tbl_room.block WHERE (tbl_halls.staff != NULL OR tbl_halls.staff != 0) AND (tbl_halls.notify_date >= '$today' OR tbl_halls.date <= '$today') AND (DATE(tbl_halls.is_notified) != '$today' OR (tbl_halls.is_notified IS NULL)) LIMIT 4;";
$query_run = mysqli_query($conn, $query);
if (mysqli_num_rows($query_run) > 0) {
    foreach ($query_run as $hall) {
        $hall_details = [];
        $hall_details['hall_id']        = $hall['hall_id'];
        $hall_details['date']           = $hall['date'];
        $hall_details['start_time']     = $hall['start_time'];
        $hall_details['end_time']       = $hall['end_time'];
        $hall_details['staff']          = $hall['staff'];
        $hall_details['allocated']      = $hall['allocated'];
        $hall_details['room_id']        = $hall['room_id'];
        $hall_details['deptname']       = $hall['deptname'];
        $hall_details['block']          = $hall['block'];
        $hall_details['row_dim']        = $hall['row_dim'];
        $hall_details['col_dim']        = $hall['col_dim'];
        $hall_details['capacity']       = $hall['capacity'];
        $hall_details['room']           = $hall['room'];
        $hall_details['exam_details']   = json_decode($hall['exam_details']);

        $exam_details = [];
        foreach ($hall_details['exam_details'] as $exam) {
            $query = "SELECT * FROM tbl_exams WHERE id='" . $exam->exam_id . "'";
            $query_run = mysqli_query($conn, $query);
            if (mysqli_num_rows($query_run) > 0 ){
                foreach ($query_run as $exam_det) {
                    $t['exam_id'] = $exam_det['id'];
                    $t['exam_name'] = $exam_det['exam_name'];
                    $t['exam_subject_name'] = $exam_det['exam_subject_name'];
                    $t['exam_subject_code'] = $exam_det['exam_subject_code'];
                    $t['exam_dept'] = $exam_det['exam_dept'];
                    $t['exam_batch'] = $exam_det['exam_batch'];

                    array_push($exam_details, $t);
                }
            }
        }

        $students = [];
        $query = "SELECT tbl_hall_student.*, tbl_student.regno, tbl_student.firstname, tbl_student.lastname FROM tbl_hall_student INNER JOIN tbl_student ON tbl_student.id=tbl_hall_student.s_id WHERE hall_id = '".$hall_details['hall_id']."' ORDER BY tbl_hall_student.exam_id, tbl_hall_student.id ASC;";
        $query_run = mysqli_query($conn, $query);
        if (mysqli_num_rows($query_run) > 0) {
            foreach ($query_run as $stud) {
                $t = [$stud['exam_id'], $stud['regno'], $stud['firstname'] . ' ' . $stud['lastname']];
                array_push($students, $t);
            }
        }

        // Code to generate PDF
        $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        // $pdf->SetTitle("Seating Arrangement");  
        // $pdf->SetHeaderData(PDF_HEADER_LOGO, 150, PDF_HEADER_TITLE, PDF_HEADER_STRING);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont('helvetica');
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetAutoPageBreak(TRUE, 10);
        $pdf->SetFont('helvetica', '', 10);
        $pdf->AddPage(); //default A4
        //$pdf->AddPage('P','A5'); //when you require custome page size 

        $dimensions = $pdf->getPageDimensions();
        
        $info_right_column = '';
        $info_left_column  = '';

        // $info_left_column .= '<b>Exams</b><br>';

        // foreach($exam_details as $exam) {
        //     $info_left_column .= $exam['exam_name'] . ' - ' . $exam['exam_subject_name'] . ' (' . $exam['exam_subject_code'] . ')<br>';
        // }

        $info_right_column .= '<span style="font-weight:bold;font-size:14px;">' . 'ROOM : ' . $hall_details['room'] . '</span><br />';
        $info_right_column .= '<b style="color:#4e4e4e;">DATE : ' . $hall_details['date'] . '</b><br>';
        $info_right_column .= '<b style="color:#4e4e4e;">TIME : ' . $hall_details['start_time'] . ' to ' . $hall_details['end_time'] . '</b>';

        $image_file = '../assets/images/logo.jpg';
        $pdf->Image($image_file, 10, 10, 190, '', 'JPG', '', 'C', false, 300, '', false, false, 0, true, false, false);
        $pdf->ln(10);
        $pdf->ln(10);
        $pdf->ln(10);
        $pdf->ln(10);
        // $pdf->ln(10);
        pdf_multi_row($info_left_column, $info_right_column, $pdf, ($dimensions['wk'] / 2) - $dimensions['lm']);

        $pdf->ln(10);

        $content = '<table border="1" cellspacing="0" cellpadding="6">';
        $content .= '<tr align="center"><th><b>Seat No.</b></th><th><b>Regno</b></th><th><b>Student Name</b></th></tr>';
    
        $k = 1;
        for ($i=0; $i<count($exam_details); $i++) {
            // $content .= '<tr><td colspan="3" align="center"><b>Exam: '.$exam_details[$i]['exam_name'] . ' - ' . $exam_details[$i]['exam_subject_name'] . ' ' . $exam_details[$i]['exam_subject_code'].'</b></td></tr>';
            for ($j=0; $j<count($students); $j++) {
                if ($exam_details[$i]['exam_id'] == $students[$j][0]) {
                    $content .= '<tr align="center"><td>'.$k.'</td><td>'.$students[$j][1].'</td><td>'.$students[$j][2].'</td></tr>';
                    $k += 1;
                }
            }
        }
    
        $content .= '</table>';
    
        $pdf->writeHTML($content);
        
        $pdf->writeHTML('<br><br>');

        $pdf->writeHTML('<h4 align="right">Invigilator Signature</h4>');
        if ($hall_details['staff'] != 0 ) {
            $pdf->writeHTML('<h4 align="right">'.get_staff_name($hall_details['staff']).'</h4>');
        }

        // $file_location = "/home/fbi1glfa0j7p/public_html/examples/generate_pdf/uploads/"; //add your full path of your server
        $file_location = "C://xampp/htdocs/examcell/uploads/"; //for local xampp server

        $datetime = date('dmY_hms');
        $file_name = "HSA_" . $datetime . ".pdf";
        ob_end_clean();
        
        if ($hall_details['staff'] != null && $hall_details['staff'] != 0) {
            $staff_mail = get_staff_email($hall_details['staff']);
            $mail_content = 'Hi ' . get_staff_name($hall_details['staff']) . '!<br>';
            $mail_content .= 'You are assigned as an invigilator to the exams that are conducted on <b>'.$hall_details['date'].'</b> at <b>'.$hall_details['start_time'] . ' to ' . $hall_details['end_time'].'</b>.<br>';
            $mail_content .= 'Please follow the seating arrangement plan as per the PDF attached below.';
            if (send_cron_mail($staff_mail, 'Seating Allotment', $mail_content, [$file_name, $pdf->Output($file_name, 'S')])) {
                $query = "UPDATE tbl_halls SET is_notified= NOW() WHERE id='" . $hall['hall_id'] . "'";
                $query_run = mysqli_query($conn, $query);
                sleep(2);
                continue;
            } else {
                // update service
                $reset_date = date('Y-m-d H:i:s', strtotime($today . '+ 1day'));
                $query = "UPDATE tbl_email_service SET status=-1, reset_datetime='$reset_date' WHERE id='".$email_service['id']."'";
                mysqli_query($conn, $query);

                global $email_service;
                $email_service = [];
                $query = "SELECT * FROM tbl_email_service WHERE status=0 OR status=1 ORDER BY status DESC LIMIT 1";
                $query_run = mysqli_query($conn, $query);
                if (mysqli_num_rows($query_run) > 0) {
                    foreach ($query_run as $service) {
                        $email_service['id'] = $service['id'];
                        $email_service['email'] = $service['email'];
                        $properties = json_decode($service['properties']);
                        $email_service['email_username'] = $properties->email_username;
                        $email_service['email_host'] = $properties->email_host;
                        $email_service['email_secure'] = $properties->email_secure;
                        $email_service['email_port'] = $properties->email_port;
                        $email_service['password'] = $properties->password;
                        $email_service['status'] = $service['status'];
                    }
                } else {
                    exit();
                }
            }
        }
    }
}

// Mail Students two day before the exam
$exam_batched = [];
$query = "SELECT tbl_hall_student.* FROM tbl_hall_student INNER JOIN tbl_exams ON tbl_exams.id=tbl_hall_student.exam_id WHERE (tbl_exams.notify_date >= '$today' OR tbl_exams.exam_date <= '$today') AND (tbl_exams.batched=-1 OR tbl_exams.batched=1) AND tbl_hall_student.is_notified IS NULL ORDER BY tbl_hall_student.id ASC LIMIT 9;";
$query_run = mysqli_query($conn, $query);
if (mysqli_num_rows($query_run) > 0) {
    foreach ($query_run as $stud) {
        $query = "SELECT * FROM tbl_exams WHERE id='".$stud['exam_id']."'";
        $query_run = mysqli_query($conn, $query);
        if ($query_run) {
            $exam_details = mysqli_fetch_assoc($query_run);
            $student = get_student_detail($stud['s_id']);
            $room = get_room_detail($stud['hall_id']);

            $mail_content = 'Hi '.$student['firstname'] . ' ' . $student['lastname'].'!<br>';
            $mail_content .= '<b>'.$exam_details['exam_name'] . ' ' . $exam_details['exam_subject_name'] . ' ' . $exam_details['exam_subject_code'].'</b> on <b>'.$exam_details['exam_date'].' at '.$exam_details['exam_start_time'].' to '.$exam_details['exam_end_time'].'</b> is allotted in the below hall.<br>';
            $mail_content .= 'Room: '.$room['room'].'<br>';
            $mail_content .= 'Dept: '.$room['deptname'].'<br>';
            $mail_content .= 'Block: '.$room['block'].'<br>';
            $mail_content .= '<br><br>Thank You!';
            
            if (send_cron_mail($student['email'], 'Exam Hall Allotment', $mail_content)) {
                if (!in_array($stud['exam_id'], $exam_batched, true)) {
                    array_push($exam_batched, $stud['exam_id']);
                }
                $query = "UPDATE tbl_hall_student SET is_notified=NOW() WHERE id='".$stud['id']."'";
                $query_run = mysqli_query($conn, $query);
                sleep(2);
                continue;
            } else {
                // update service
                $reset_date = date('Y-m-d H:i:s', strtotime($today . '+ 1day'));
                $query = "UPDATE tbl_email_service SET status=-1, reset_datetime='$reset_date' WHERE id='".$email_service['id']."'";
                mysqli_query($conn, $query);
    
                global $email_service;
                $email_service = [];
                $query = "SELECT * FROM tbl_email_service WHERE status=0 OR status=1 ORDER BY status DESC LIMIT 1";
                $query_run = mysqli_query($conn, $query);
                if (mysqli_num_rows($query_run) > 0) {
                    foreach ($query_run as $service) {
                        $email_service['id'] = $service['id'];
                        $email_service['email'] = $service['email'];
                        $properties = json_decode($service['properties']);
                        $email_service['email_username'] = $properties->email_username;
                        $email_service['email_host'] = $properties->email_host;
                        $email_service['email_secure'] = $properties->email_secure;
                        $email_service['email_port'] = $properties->email_port;
                        $email_service['password'] = $properties->password;
                        $email_service['status'] = $service['status'];
                    }
                } else {
                    exit();
                }
            }
        }
    }

    if ($exam_batched != []) {
        foreach ($exam_batched as $exam) {
            $query = "SELECT COUNT(tbl_hall_student.id) as total, COUNT(tbl_hall_student.is_notified) as notified FROM tbl_hall_student WHERE exam_id=$exam;";
            $query_run = mysqli_query($conn, $query);
            if ($query_run) {
                $row = mysqli_fetch_assoc($query_run);
                if ($row['total'] == $row['notified']) {
                    $query = "UPDATE tbl_exams SET batched=0 WHERE tbl_exams.id='$exam'";
                } else {
                    $query = "UPDATE tbl_exams SET batched=1 WHERE tbl_exams.id='$exam'";
                }

                $qr = mysqli_query($conn, $query);
            }
        }
    }
}

function get_student_detail($stud_id) {
    global $conn;
    $query = "SELECT id, regno, firstname, lastname, email FROM tbl_student WHERE id=$stud_id";
    $query_run = mysqli_query($conn, $query);
    if ($query_run) {
        $row = mysqli_fetch_assoc($query_run);
        return $row;
    }
}
function get_room_detail($room_id) {
    global $conn;
    $query="SELECT tbl_room.id as room_id, tbl_room.room, tbl_block.block, tbl_department.deptname FROM tbl_halls INNER JOIN tbl_room ON tbl_room.id=tbl_halls.room INNER JOIN tbl_block ON tbl_block.id=tbl_room.block INNER JOIN tbl_department ON tbl_department.id=tbl_block.dept WHERE tbl_halls.id=$room_id;";
    $query_run = mysqli_query($conn, $query);
    if ($query_run) {
        $row = mysqli_fetch_assoc($query_run);
        return $row;
    }
}

/**
 * send_cron_mail function to send email notification
 * https://github.com/PHPMailer/PHPMailer
 */
function send_cron_mail($toEmail, $subject, $content, $attachment = []) {

    global $email_service;
    require '../database/constants.php';

    if (SEND_EMAIL === TRUE) {
        // PHPMailer Mail Configuration
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = $email_service['email_host'];
        $mail->SMTPAuth = TRUE;
        $mail->Username = $email_service['email_username'];
        $mail->Password = $email_service['password'];
        $mail->SMTPSecure = $email_service['email_secure'];
        // $mail->SMTPDebug = TRUE;
        $mail->Port = $email_service['email_port'];
        
        // Set From Email Address
        $mail->setFrom($email_service['email_username']);
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
        try {
            if ($mail->send()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    } else {
        return false;
    }
}

function pdf_multi_row($left, $right, $pdf, $left_width = 40)
{
    // MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0)

    $page_start = $pdf->getPage();
    $y_start    = $pdf->GetY();

    // write the left cell
    $pdf->MultiCell($left_width, 0, $left, 0, 'L', 0, 2, '', '', true, 0, true);

    $page_end_1 = $pdf->getPage();
    $y_end_1    = $pdf->GetY();

    $pdf->setPage($page_start);

    // write the right cell
    $pdf->MultiCell(0, 0, $right, 0, 'R', 0, 1, $pdf->GetX(), $y_start, true, 0, true);

    $page_end_2 = $pdf->getPage();
    $y_end_2    = $pdf->GetY();

    // set the new row position by case
    if (max($page_end_1, $page_end_2) == $page_start) {
        $ynew = max($y_end_1, $y_end_2);
    } elseif ($page_end_1 == $page_end_2) {
        $ynew = max($y_end_1, $y_end_2);
    } elseif ($page_end_1 > $page_end_2) {
        $ynew = $y_end_1;
    } else {
        $ynew = $y_end_2;
    }

    $pdf->setPage(max($page_end_1, $page_end_2));
    $pdf->SetXY($pdf->GetX(), $ynew);
}

function get_staff_name($staff_id) {
    global $conn;
    $query = "SELECT tbl_staff.firstname, tbl_staff.lastname FROM tbl_staff WHERE tbl_staff.id='".$staff_id."'";
    $query_run = mysqli_query($conn,$query);
    if ($query_run) {
        $row = mysqli_fetch_array($query_run);
        return $row['firstname'] . ' ' . $row['lastname'];
    }
}

function get_staff_email($staff_id) {
    global $conn;
    $query = "SELECT email from tbl_staff WHERE id='$staff_id'";
    $query_run = mysqli_query($conn, $query);
    if ($query_run) {
        $row = mysqli_fetch_array($query_run);
        return $row['email'];
    }
}