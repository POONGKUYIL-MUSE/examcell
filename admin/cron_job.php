<?php
session_start();
require '../database/config.php';
include_once('../assets/tcpdf/tcpdf.php');

require '../assets/phpmailer/src/PHPMailer.php';
require '../assets/phpmailer/src/Exception.php';
require '../assets/phpmailer/src/SMTP.php';

// current date
$today = date('Y-m-d');

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

// Mail Students on a day before the exam and on the day of the exam
$query = "SELECT * FROM tbl_exams WHERE (tbl_exams.notify_date = '$today' OR tbl_exams.exam_date = '$today') AND (DATE(tbl_exams.is_notified) != '$today' OR (tbl_exams.is_notified IS NULL));";
$query_run = mysqli_query($conn, $query);
if (mysqli_num_rows($query_run) > 0) {
    foreach ($query_run as $exam) {
        $exam_details = [];
        $exam_details['exam_name'] = $exam['exam_name'];
        $exam_details['exam_date'] = $exam['exam_date'];
        $exam_details['exam_start_time'] = $exam['exam_start_time'];
        $exam_details['exam_end_time'] = $exam['exam_end_time'];
        $exam_details['exam_subject_name'] = $exam['exam_subject_name'];
        $exam_details['exam_subject_code'] = $exam['exam_subject_code'];
        $exam_details['exam_dept'] = $exam['exam_dept'];
        $exam_details['exam_batch'] = $exam['exam_batch'];

        $students = [];
        if ($exam_details['exam_dept'] != 0 && $exam_details['exam_batch'] != 0) {
            $query = "SELECT * FROM tbl_student WHERE student_department='".$exam_details['exam_dept']."' AND student_batch='".$exam_details['exam_batch']."' ORDER BY tbl_student.regno ASC";
            $query_run = mysqli_query($conn, $query);
            if (mysqli_num_rows($query_run) > 0) {
                foreach ($query_run as $student) {
                    $t = [];
                    $t['regno'] = $student['regno'];
                    $t['student_name'] = $student['firstname'] . ' ' . $student['lastname'];
                    $t['email'] = $student['email'];

                    $query="SELECT tbl_room.room, tbl_block.block, tbl_department.deptname FROM tbl_hall_student INNER JOIN tbl_halls ON tbl_halls.id=tbl_hall_student.hall_id INNER JOIN tbl_room ON tbl_room.id=tbl_halls.room INNER JOIN tbl_block ON tbl_block.id=tbl_room.block INNER JOIN tbl_department ON tbl_department.id=tbl_block.dept WHERE tbl_hall_student.exam_id='".$exam['id']."' AND tbl_hall_student.s_id='".$student['id']."'";
                    $query_run = mysqli_query($conn, $query);
                    if (mysqli_num_rows($query_run) > 0) {
                        $row = mysqli_fetch_array($query_run);
                        $t['exam_deptname'] = $row['deptname'];
                        $t['exam_block'] = $row['block'];
                        $t['exam_room'] = $row['room'];
                    }
                                        
                    array_push($students, $t);
                }
            }
        }

        foreach ($students as $student) {

            $mail_content = 'Hi '.$student['student_name'].'!<br>';
            $mail_content .= '<b>'.$exam_details['exam_name'] . ' ' . $exam_details['exam_subject_name'] . ' ' . $exam['exam_subject_code'].'</b> on <b>'.$exam['exam_date'].' at '.$exam['exam_start_time'].' to '.$exam['exam_end_time'].'</b> is allotted in the below hall.<br>';
            $mail_content .= 'Room: '.$student['exam_room'].'<br>';
            $mail_content .= 'Dept: '.$student['exam_deptname'].'<br>';
            $mail_content .= 'Block: '.$student['exam_block'].'<br>';
            $mail_content .= '<br><br>Thank You!';

            send_email($student['email'], 'Exam Hall Allotment', $mail_content);

        }
        $query = "UPDATE tbl_exams SET is_notified=NOW() WHERE id='".$exam['id']."'";
        $query_run = mysqli_query($conn, $query);
        
    }
}

// Mail Invigilating staffs on a day before the exam and on the day of the exam
$attachments = [];
$query = "SELECT tbl_halls.id as hall_id, tbl_halls.*, tbl_room.id as room_id, tbl_room.*, tbl_department.deptname, tbl_block.block FROM tbl_halls INNER JOIN tbl_room ON tbl_room.id=tbl_halls.room INNER JOIN tbl_department ON tbl_department.id=tbl_room.dept INNER JOIN tbl_block ON tbl_block.id=tbl_room.block WHERE (tbl_halls.staff != NULL OR tbl_halls.staff != 0) AND (tbl_halls.notify_date = '$today' OR tbl_halls.date = '$today') AND (DATE(tbl_halls.is_notified) != '$today' OR (tbl_halls.is_notified IS NULL))";
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
        $query = "SELECT tbl_hall_student.*, tbl_student.regno FROM tbl_hall_student INNER JOIN tbl_student ON tbl_student.id=tbl_hall_student.s_id WHERE hall_id = '".$hall_details['hall_id']."' ORDER BY tbl_hall_student.id ASC;";
        $query_run = mysqli_query($conn, $query);
        if (mysqli_num_rows($query_run) > 0) {
            foreach ($query_run as $stud) {
                array_push($students, $stud['regno']);
            }
        }

        // Code to generate PDF
        $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
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
        $pdf->SetFont('helvetica', '', 12);
        $pdf->AddPage(); //default A4
        //$pdf->AddPage('P','A5'); //when you require custome page size 

        $dimensions = $pdf->getPageDimensions();
        
        $info_right_column = '';
        $info_left_column  = '';

        $info_left_column .= '<b>Exams</b><br>';

        foreach($exam_details as $exam) {
            $info_left_column .= $exam['exam_name'] . ' - ' . $exam['exam_subject_name'] . ' (' . $exam['exam_subject_code'] . ')<br>';
        }

        $info_right_column .= '<span style="font-weight:bold;font-size:14px;">' . 'ROOM : ' . $hall_details['room'] . '</span><br />';
        $info_right_column .= '<b style="color:#4e4e4e;">DATE : ' . $hall_details['date'] . '</b><br>';
        $info_right_column .= '<b style="color:#4e4e4e;">TIME : ' . $hall_details['start_time'] . ' to ' . $hall_details['end_time'] . '</b>';

        $image_file = '../assets/images/logo.jpg';
        $pdf->Image($image_file, 30, 10, 230, '', 'JPG', '', 'C', false, 300, '', false, false, 0, true, false, false);
        $pdf->ln(10);
        $pdf->ln(10);
        $pdf->ln(10);
        $pdf->ln(10);
        $pdf->ln(10);
        pdf_multi_row($info_left_column, $info_right_column, $pdf, ($dimensions['wk'] / 2) - $dimensions['lm']);

        $pdf->ln(10);

        $pdf->writeHTML('<br><b> | (blackboard) >>></b><br>', true);

        $tab = '<table border="1" cellspacing="0" cellpadding="10" align="center">';
        $allot = 0;

        $columns = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
        for ($j=0; $j<=($hall_details['col_dim']); $j++) {
            $tab .= '<tr>';
                for ($i=0; $i<=$hall_details['row_dim']; $i++) {
                if ($i == 0) {
                    if ($i == 0 && $j == 0) {
                        $tab .= '<th width="15%"><b>#</b></th>';
                    } else {
                        $tab .= '<th width="15%"><b>Col.'. $columns[$j-1] .'</b></th>';
                    }

                } else {
                    if ($j == 0) {
                        $tab .= '<td width="15%">Row.'.$i .'</td>';
                    } else {
                        if ($allot < $hall_details['capacity']) {
                            $tab .= '<td width="15%">'.$students[$allot].'</td>';
                            $allot += 1;
                        }
                    }
                }
            }
            $tab .= '</tr>';
        }
        $tab .= '</table>';

        $pdf->writeHTMLCell(0, 0, '30', '', $tab, 0, 1, false, true, 'C', true);
        
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

        // array_push($attachments, $pdf->Output($file_name, 'S'));

        if ($hall_details['staff'] != null && $hall_details['staff'] != 0) {
            $staff_mail = get_staff_email($hall_details['staff']);
            $mail_content = 'Hi ' . get_staff_name($hall_details['staff']) . '!<br>';
            $mail_content .= 'You are assigned as an invigilator to the exams that are conducted on <b>'.$hall_details['date'].'</b> at <b>'.$hall_details['start_time'] . ' to ' . $hall_details['end_time'].'</b>.<br>';
            $mail_content .= 'Please follow the seating arrangement plan as per the PDF attached below.';
            send_email($staff_mail, 'Seating Allotment', $mail_content, [$file_name, $pdf->Output($file_name, 'S')]);

            $query = "UPDATE tbl_halls SET is_notified= NOW() WHERE id='" . $hall_details['hall_id'] . "'";
            $query_run = mysqli_query($conn, $query);
            
        }

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
    $mail->Password = 'aysesarllmjhtzrm';   // App specific password
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
    $mail->send();
}

function get_staff_email($staff_id) {
    require '../database/config.php';
    $query = "SELECT email from tbl_staff WHERE id='$staff_id'";
    $query_run = mysqli_query($conn, $query);
    if ($query_run) {
        $row = mysqli_fetch_array($query_run);
        return $row['email'];
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
    require '../database/config.php';
    $query = "SELECT tbl_staff.firstname, tbl_staff.lastname FROM tbl_staff WHERE tbl_staff.id='".$staff_id."'";
    $query_run = mysqli_query($conn,$query);
    if ($query_run) {
        $row = mysqli_fetch_array($query_run);
        return $row['firstname'] . ' ' . $row['lastname'];
    }
}