<?php
session_start();
require '../database/config.php';
include_once('../assets/tcpdf/tcpdf.php');

if (isset($_POST['save_staff'])) {
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phonenumber = mysqli_real_escape_string($conn, $_POST['phonenumber']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $password = md5($password);

    $query = "INSERT INTO tbl_staff (firstname,lastname,email,phonenumber,password,admin,active,created_at,created_by,updated_at,updated_by) VALUES 
    ('$firstname','$lastname','$email','$phonenumber','$password',0,1,NOW(),1,NOW(),1)";

    $query_run = mysqli_query($conn, $query);
    if ($query_run) {
        $_SESSION['message'] = "Staff Added Successfully";
        header("Location: staff.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Staff Not Added";
        header("Location: staff_create_edit.php");
        exit(0);
    }
}

if (isset($_POST['update_staff'])) {
    $staff_id = mysqli_real_escape_string($conn, $_POST['id']);

    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phonenumber = mysqli_real_escape_string($conn, $_POST['phonenumber']);
    $staff_department = mysqli_real_escape_string($conn, $_POST['staff_department']);

    if (isset($_POST['password'])) {
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $password = md5($password);
    }

    $query = "UPDATE tbl_staff SET firstname='$firstname', lastname='$lastname', email='$email', phonenumber='$phonenumber', staff_department='$staff_department', updated_at=NOW(), updated_by=1 ";
    if (!empty($password)) {
        $query .= ", password='$password' ";
    }
    $query .=  "WHERE id='$staff_id' ";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['message'] = "Staff Updated Successfully";
        header("Location: staff.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Staff Not Updated";
        header("Location: staff_create_edit.php?id=" . $staff_id);
        exit(0);
    }
}

if (isset($_POST['delete_staff'])) {
    $staff_id = mysqli_real_escape_string($conn, $_POST['delete_staff']);

    $query = "DELETE FROM tbl_staff WHERE id='$staff_id' ";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['message'] = "Staff Deleted Successfully";
        header("Location: staff.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Staff Not Deleted";
        header("Location: staff.php");
        exit(0);
    }
}

if (isset($_POST['save_student'])) {
    $regno = mysqli_real_escape_string($conn, $_POST['regno']);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phonenumber = mysqli_real_escape_string($conn, $_POST['phonenumber']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $student_department = mysqli_real_escape_string($conn, $_POST['student_department']);
    $student_batch = mysqli_real_escape_string($conn, $_POST['student_batch']);
    $password = md5($password);

    $query = "INSERT INTO tbl_student (regno,firstname,lastname,email,phonenumber,password,student_department,student_batch,active,created_at,created_by,updated_at,updated_by) VALUES 
    ('$regno','$firstname','$lastname','$email','$phonenumber','$password','$student_department','$student_batch',1,NOW(),1,NOW(),1)";

    $query_run = mysqli_query($conn, $query);
    if ($query_run) {
        $_SESSION['message'] = "Student Added Successfully";
        header("Location: student.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Student Not Added";
        header("Location: student_create_edit.php");
        exit(0);
    }
}

if (isset($_POST['update_student'])) {
    $student_id = mysqli_real_escape_string($conn, $_POST['id']);

    $regno = mysqli_real_escape_string($conn, $_POST['regno']);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phonenumber = mysqli_real_escape_string($conn, $_POST['phonenumber']);
    $student_department = mysqli_real_escape_string($conn, $_POST['student_department']);
    $student_batch = mysqli_real_escape_string($conn, $_POST['student_batch']);

    if (isset($_POST['password'])) {
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $password = md5($password);
    }

    $query = "UPDATE tbl_student SET regno='$regno', firstname='$firstname', lastname='$lastname', email='$email', phonenumber='$phonenumber', student_department='$student_department', student_batch='$student_batch', updated_at=NOW(), updated_by=1 ";
    if (!empty($password)) {
        $query .= ", password='$password' ";
    }
    $query .=  "WHERE id='$student_id' ";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['message'] = "Student Updated Successfully";
        header("Location: student.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Student Not Updated";
        header("Location: student_create_edit.php?id=" . $student_id);
        exit(0);
    }
}

if (isset($_POST['delete_student'])) {
    $student_id = mysqli_real_escape_string($conn, $_POST['delete_student']);

    $query = "DELETE FROM tbl_student WHERE id='$student_id' ";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['message'] = "Student Deleted Successfully";
        header("Location: student.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Student Not Deleted";
        header("Location: student.php");
        exit(0);
    }
}

if (isset($_POST['save_department'])) {
    $deptname = mysqli_real_escape_string($conn, $_POST['deptname']);
    $deptslug = mysqli_real_escape_string($conn, $_POST['deptslug']);

    $query = "INSERT INTO tbl_department (deptname, deptslug) VALUES ('$deptname', '$deptslug')";

    $query_run = mysqli_query($conn, $query);
    if ($query_run) {
        $_SESSION['message'] = "Department Added Successfully";
        header("Location: department.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Department Not Added";
        header("Location: department_create_edit.php");
        exit(0);
    }
}

if (isset($_POST['update_department'])) {
    $department_id = mysqli_real_escape_string($conn, $_POST['id']);

    $deptname = mysqli_real_escape_string($conn, $_POST['deptname']);
    $deptslug = mysqli_real_escape_string($conn, $_POST['deptslug']);

    $query = "UPDATE tbl_department SET deptname='$deptname', deptslug='$deptslug'";
    $query .=  "WHERE id='$department_id' ";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['message'] = "Department Updated Successfully";
        header("Location: department.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Department Not Updated";
        header("Location: department_create_edit.php?id=" . $department_id);
        exit(0);
    }
}

if (isset($_POST['delete_department'])) {
    $department_id = mysqli_real_escape_string($conn, $_POST['delete_department']);

    $query = "DELETE FROM tbl_department WHERE id='$department_id' ";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['message'] = "Department Deleted Successfully";
        header("Location: department.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Department Not Deleted";
        header("Location: department.php");
        exit(0);
    }
}

if (isset($_POST['save_batch'])) {
    $dept = mysqli_real_escape_string($conn, $_POST['dept']);
    $batchyear = mysqli_real_escape_string($conn, $_POST['batchyear']);

    $query = "INSERT INTO tbl_batch (dept, batchyear) VALUES ('$dept', '$batchyear')";

    $query_run = mysqli_query($conn, $query);
    if ($query_run) {
        $_SESSION['message'] = "Batch Added Successfully";
        header("Location: batch.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Batch Not Added";
        header("Location: batch_create_edit.php");
        exit(0);
    }
}

if (isset($_POST['update_batch'])) {
    $batch_id = mysqli_real_escape_string($conn, $_POST['id']);

    $dept = mysqli_real_escape_string($conn, $_POST['dept']);
    $batchyear = mysqli_real_escape_string($conn, $_POST['batchyear']);

    $query = "UPDATE tbl_batch SET dept='$dept', batchyear='$batchyear'";
    $query .=  "WHERE id='$batch_id' ";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['message'] = "Batch Updated Successfully";
        header("Location: batch.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Batch Not Updated";
        header("Location: batch_create_edit.php?id=" . $batch_id);
        exit(0);
    }
}

if (isset($_POST['delete_batch'])) {
    $batch_id = mysqli_real_escape_string($conn, $_POST['delete_batch']);

    $query = "DELETE FROM tbl_batch WHERE id='$batch_id' ";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['message'] = "Batch Deleted Successfully";
        header("Location: batch.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Batch Not Deleted";
        header("Location: batch.php");
        exit(0);
    }
}

if (isset($_POST['save_block'])) {
    $dept = mysqli_real_escape_string($conn, $_POST['dept']);
    $block = mysqli_real_escape_string($conn, $_POST['block']);

    $query = "INSERT INTO tbl_block (dept, block) VALUES ('$dept', '$block')";

    $query_run = mysqli_query($conn, $query);
    if ($query_run) {
        $_SESSION['message'] = "Block Added Successfully";
        header("Location: block.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Block Not Added";
        header("Location: block_create_edit.php");
        exit(0);
    }
}

if (isset($_POST['update_block'])) {
    $block_id = mysqli_real_escape_string($conn, $_POST['id']);

    $dept = mysqli_real_escape_string($conn, $_POST['dept']);
    $block = mysqli_real_escape_string($conn, $_POST['block']);

    $query = "UPDATE tbl_block SET dept='$dept', block='$block'";
    $query .=  "WHERE id='$block_id' ";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['message'] = "Block Updated Successfully";
        header("Location: block.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Block Not Updated";
        header("Location: block_create_edit.php?id=" . $block_id);
        exit(0);
    }
}

if (isset($_POST['delete_block'])) {
    $block_id = mysqli_real_escape_string($conn, $_POST['delete_block']);

    $query = "DELETE FROM tbl_block WHERE id='$block_id' ";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['message'] = "Block Deleted Successfully";
        header("Location: block.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Block Not Deleted";
        header("Location: block.php");
        exit(0);
    }
}

if (isset($_POST['save_room'])) {
    $dept = mysqli_real_escape_string($conn, $_POST['dept']);
    $block = mysqli_real_escape_string($conn, $_POST['block']);
    $room = mysqli_real_escape_string($conn, $_POST['room']);
    $capacity = mysqli_real_escape_string($conn, $_POST['capacity']);
    $row_dim = mysqli_real_escape_string($conn, $_POST['row_dim']);
    $col_dim = mysqli_real_escape_string($conn, $_POST['col_dim']);

    $query = "INSERT INTO tbl_room (dept, block, room, capacity, row_dim, col_dim) VALUES ('$dept', '$block', '$room', '$capacity', '$row_dim', '$col_dim')";

    $query_run = mysqli_query($conn, $query);
    if ($query_run) {
        $_SESSION['message'] = "Room Added Successfully";
        header("Location: room.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Room Not Added";
        header("Location: room_create_edit.php");
        exit(0);
    }
}

if (isset($_POST['update_room'])) {
    $room_id = mysqli_real_escape_string($conn, $_POST['id']);

    $dept = mysqli_real_escape_string($conn, $_POST['dept']);
    $block = mysqli_real_escape_string($conn, $_POST['block']);
    $room = mysqli_real_escape_string($conn, $_POST['room']);
    $capacity = mysqli_real_escape_string($conn, $_POST['capacity']);
    $row_dim = mysqli_real_escape_string($conn, $_POST['row_dim']);
    $col_dim = mysqli_real_escape_string($conn, $_POST['col_dim']);

    $query = "UPDATE tbl_room SET dept='$dept', block='$block', room='$room', capacity='$capacity', row_dim='$row_dim', col_dim='$col_dim'";
    $query .=  "WHERE id='$room_id' ";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['message'] = "Room Updated Successfully";
        header("Location: room.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Room Not Updated";
        header("Location: room_create_edit.php?id=" . $room_id);
        exit(0);
    }
}

if (isset($_POST['delete_room'])) {
    $room_id = mysqli_real_escape_string($conn, $_POST['delete_room']);

    $query = "DELETE FROM tbl_room WHERE id='$room_id' ";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['message'] = "Room Deleted Successfully";
        header("Location: room.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Room Not Deleted";
        header("Location: room.php");
        exit(0);
    }
}

if (isset($_POST['get_dept_blocks'])) {
    if (isset($_POST['deptid'])) {

        $deptid = $_POST['deptid'];
        $query = "SELECT * FROM tbl_block WHERE dept='$deptid'";

        $blocks = [];

        $query_run = mysqli_query($conn, $query);
        if (mysqli_num_rows($query_run) > 0) {
            foreach ($query_run as $block) {
                $temp['blockid'] = $block['id'];
                $temp['dept'] = $block['dept'];
                $temp['blockname'] = $block['block'];

                array_push($blocks, $temp);
            }
        }
        // header('Content-type: application/json');
        echo json_encode([
            "success" => true,
            "blocks" => $blocks
        ]);
    } else {
        echo json_encode([
            "success" => false
        ]);
    }
}

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

if (isset($_POST['get_department_staffs'])) {
    if (isset($_POST['deptid'])) {

        $deptid = $_POST['deptid'];
        $query = "SELECT * FROM tbl_staff WHERE staff_department='$deptid'";

        $staffs = [];

        $query_run = mysqli_query($conn, $query);
        if (mysqli_num_rows($query_run) > 0) {
            foreach ($query_run as $staff) {
                $temp['staffid'] = $staff['id'];
                $temp['staff_department'] = $staff['staff_department'];
                $temp['name'] = $staff['firstname'] . ' ' . $staff['lastname'];

                array_push($staffs, $temp);
            }
        }
        // header('Content-type: application/json');
        echo json_encode([
            "success" => true,
            "staffs" => $staffs
        ]);
    } else {
        echo json_encode([
            "success" => false
        ]);
    }
}

if (isset($_POST['get_exam_capacity'])) {
    if (isset($_POST['deptid']) && isset($_POST['batchid'])) {

        $deptid = $_POST['deptid'];
        $batchid = $_POST['batchid'];
        $query = "SELECT * FROM tbl_student WHERE student_department='$deptid' AND student_batch='$batchid'";

        $student_capacity = 0;

        $query_run = mysqli_query($conn, $query);
        if (mysqli_num_rows($query_run) > 0) {
            $student_capacity = mysqli_num_rows($query_run);
            // foreach ($query_run as $staff) {
            //     $temp['staffid'] = $staff['id'];
            //     $temp['staff_department'] = $staff['staff_department'];
            //     $temp['name'] = $staff['firstname'] . ' ' . $staff['lastname'];

            //     array_push($students,$temp);
            // }
        }
        echo json_encode([
            "success" => true,
            "student_capacity" => $student_capacity
        ]);
    } else {
        echo json_encode([
            "success" => false
        ]);
    }
}

if (isset($_POST['save_exam'])) {
    $exam_name = mysqli_real_escape_string($conn, $_POST['exam_name']);
    $exam_subject_name = mysqli_real_escape_string($conn, $_POST['exam_subject_name']);
    $exam_subject_code = mysqli_real_escape_string($conn, $_POST['exam_subject_code']);
    $exam_start_time = mysqli_real_escape_string($conn, $_POST['exam_start_time']);
    $exam_end_time = mysqli_real_escape_string($conn, $_POST['exam_end_time']);
    $exam_dept = mysqli_real_escape_string($conn, $_POST['exam_dept']);
    $exam_batch = mysqli_real_escape_string($conn, $_POST['exam_batch']);

    $exam_date = mysqli_real_escape_string($conn, $_POST['exam_date']);
    $exam_date = date("Y-m-d", strtotime($exam_date));

    $query = "INSERT INTO tbl_exams (exam_name, exam_subject_name, exam_subject_code, exam_date, exam_start_time, exam_end_time, exam_dept, exam_batch) VALUES 
    ('$exam_name', '$exam_subject_name', '$exam_subject_code', '$exam_date', '$exam_start_time', '$exam_end_time', '$exam_dept', '$exam_batch')";

    $query_run = mysqli_query($conn, $query);
    if ($query_run) {
        $_SESSION['message'] = "Exam Added Successfully";
        header("Location: exams.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Exam Not Added";
        header("Location: exam_create_edit.php");
        exit(0);
    }
}

if (isset($_POST['update_exam'])) {
    $exam_id = mysqli_real_escape_string($conn, $_POST['id']);

    $exam_name = mysqli_real_escape_string($conn, $_POST['exam_name']);
    $exam_subject_name = mysqli_real_escape_string($conn, $_POST['exam_subject_name']);
    $exam_subject_code = mysqli_real_escape_string($conn, $_POST['exam_subject_code']);
    $exam_start_time = mysqli_real_escape_string($conn, $_POST['exam_start_time']);
    $exam_end_time = mysqli_real_escape_string($conn, $_POST['exam_end_time']);
    $exam_dept = mysqli_real_escape_string($conn, $_POST['exam_dept']);
    $exam_batch = mysqli_real_escape_string($conn, $_POST['exam_batch']);
    $exam_status = mysqli_real_escape_string($conn, $_POST['status']);

    $exam_date = mysqli_real_escape_string($conn, $_POST['exam_date']);
    $exam_date = date("Y-m-d", strtotime($exam_date));

    $query = "UPDATE tbl_exams SET exam_name='$exam_name', exam_subject_name='$exam_subject_name', exam_subject_code='$exam_subject_code', exam_date='$exam_date', exam_start_time='$exam_start_time', exam_end_time='$exam_end_time', exam_dept='$exam_dept', exam_batch='$exam_batch', status='$exam_status'";
    $query .=  "WHERE id='$exam_id' ";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['message'] = "Exam Updated Successfully";
        header("Location: exams.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Exam Not Updated";
        header("Location: exam_create_edit.php?id=" . $exam_id);
        exit(0);
    }
}

if (isset($_POST['delete_exam'])) {
    $exam_id = mysqli_real_escape_string($conn, $_POST['delete_exam']);

    $query = "DELETE FROM tbl_exams WHERE id='$exam_id' ";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['message'] = "Exam Deleted Successfully";
        header("Location: exams.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Exam Not Deleted";
        header("Location: exams.php");
        exit(0);
    }
}

if (isset($_POST['get_exam_based_on_dates'])) {
    if (isset($_POST['exam_date'])) {

        $exam_date = $_POST['exam_date'];
        $exam_date = date("Y-m-d", strtotime($exam_date));
        $query = "SELECT tbl_exams.*, tbl_department.deptname as exam_deptname, tbl_batch.batchyear as batchyear FROM tbl_exams INNER JOIN tbl_department ON tbl_department.id=tbl_exams.exam_dept INNER JOIN tbl_batch ON tbl_batch.id=tbl_exams.exam_batch WHERE tbl_exams.exam_date='$exam_date' AND tbl_exams.status=0";

        $exams = [];

        $query_run = mysqli_query($conn, $query);
        if (mysqli_num_rows($query_run) > 0) {
            foreach ($query_run as $exam) {
                $temp['exam_id'] = $exam['id'];
                $temp['exam_name'] = $exam['exam_name'];
                $temp['exam_subject_name'] = $exam['exam_subject_name'];
                $temp['exam_subject_code'] = $exam['exam_subject_code'];
                $temp['exam_deptname'] = $exam['exam_deptname'];
                $temp['exam_dept'] = $exam['exam_dept'];
                $temp['exam_batch'] = $exam['batchyear'];
                $temp['exam_start_time'] = $exam['exam_start_time'];
                $temp['exam_end_time'] = $exam['exam_end_time'];

                $query = "SELECT * FROM tbl_student WHERE student_department='" . $exam['exam_dept'] . "' AND student_batch='" . $exam['exam_batch'] . "'";
                $query_run_2 = mysqli_query($conn, $query);
                if (mysqli_num_rows($query_run_2) > 0) {
                    $temp['exam_capacity'] = mysqli_num_rows($query_run_2);
                } else {
                    $temp['exam_capacity'] = 0;
                }

                // $temp['exam_capacity'] = $exam['exam_capacity'];

                array_push($exams, $temp);
            }
        }
        echo json_encode([
            "success" => true,
            "exams" => $exams
        ]);
    } else {
        echo json_encode([
            "success" => false
        ]);
    }
}

if (isset($_POST['get_avail_halls'])) {
    if (isset($_POST['exam_date'])) {

        $exam_date = $_POST['exam_date'];
        $exam_date = date("Y-m-d", strtotime($exam_date));
        $min_time = $_POST['min_time'];
        $max_time = $_POST['max_time'];

        $query = "SELECT tbl_room.*,tbl_halls.remaining, tbl_halls.date, tbl_halls.start_time, tbl_halls.end_time, if((tbl_halls.date='".$exam_date."' AND tbl_halls.start_time='".$min_time."' AND tbl_halls.end_time='".$max_time."') AND (tbl_halls.remaining>=0), tbl_halls.remaining, tbl_room.capacity) as avail_capacity, tbl_department.deptname as deptname, tbl_block.block as blockname FROM `tbl_halls` RIGHT JOIN tbl_room ON tbl_room.id = tbl_halls.room INNER JOIN tbl_department ON tbl_department.id = tbl_room.dept INNER JOIN tbl_block ON tbl_block.id = tbl_room.block ORDER BY tbl_room.id;";

        // $query = "SELECT tbl_room.*,if((tbl_halls.remaining is null OR (tbl_halls.remaining=0 AND tbl_halls.date<>'".$exam_date."' AND tbl_halls.start_time<>'".$min_time."' AND tbl_halls.end_time<>'".$max_time."')), tbl_room.capacity, tbl_halls.remaining) as avail_capacity, tbl_department.deptname as deptname, tbl_block.block as blockname FROM `tbl_halls` RIGHT JOIN tbl_room ON tbl_room.id = tbl_halls.room INNER JOIN tbl_department ON tbl_department.id = tbl_room.dept INNER JOIN tbl_block ON tbl_block.id = tbl_room.block;";

        // $query = "SELECT tbl_room.*, if((tbl_halls.remaining is null OR tbl_halls.remaining=0), tbl_room.capacity, tbl_halls.remaining) as avail_capacity, tbl_department.deptname as deptname, tbl_block.block as blockname FROM tbl_room LEFT JOIN tbl_halls ON tbl_room.id = tbl_halls.room INNER JOIN tbl_department ON tbl_room.dept = tbl_department.id INNER JOIN tbl_block ON tbl_room.block=tbl_block.id WHERE tbl_halls.date='$exam_date' AND tbl_halls.start_time='$min_time' AND tbl_halls.end_time='$max_time';";

        $halls = [];

        $query_run = mysqli_query($conn, $query);
        if (mysqli_num_rows($query_run) > 0) {
            foreach ($query_run as $hall) {
                if ($hall['avail_capacity'] != 0) {
                    $temp['roomid'] = $hall['id'];
                    $temp['roomdept'] = $hall['dept'];
                    $temp['deptname'] = $hall['deptname'];
                    $temp['roomblock'] = $hall['block'];
                    $temp['blockname'] = $hall['blockname'];
                    $temp['roomname'] = $hall['room'];
                    $temp['roomcapacity'] = $hall['avail_capacity'];
                    array_push($halls, $temp);
                }
            }
        } else {
            $query = "SELECT tbl_room.*, tbl_department.deptname as deptname, tbl_block.block as blockname FROM tbl_room INNER JOIN tbl_department ON tbl_room.dept=tbl_department.id INNER JOIN tbl_block ON tbl_room.block=tbl_block.id;";
            $query_run = mysqli_query($conn, $query);
            if (mysqli_num_rows($query_run) > 0) {
                foreach ($query_run as $hall) {
                    $temp['roomid'] = $hall['id'];
                    $temp['roomdept'] = $hall['dept'];
                    $temp['deptname'] = $hall['deptname'];
                    $temp['roomblock'] = $hall['block'];
                    $temp['blockname'] = $hall['blockname'];
                    $temp['roomname'] = $hall['room'];
                    $temp['roomcapacity'] = $hall['capacity'];

                    array_push($halls, $temp);
                }
            }
        }

        // $query_run = mysqli_query($conn, $query);
        // if (mysqli_num_rows($query_run) > 0) {
        //     foreach ($query_run as $hall) {
        //         $temp['roomid'] = $hall['id'];
        //         $temp['roomdept'] = $hall['dept'];
        //         $temp['deptname'] = $hall['deptname'];
        //         $temp['roomblock'] = $hall['block'];
        //         $temp['blockname'] = $hall['blockname'];
        //         $temp['roomname'] = $hall['room'];
        //         $temp['roomcapacity'] = $hall['remaining'];

        //         array_push($halls, $temp);
        //     }
        //     // foreach ($query_run as $exam) {
        //     //     $temp['exam_id'] = $exam['id'];
        //     //     $temp['exam_name'] = $exam['exam_name'];
        //     //     $temp['exam_subject_name'] = $exam['exam_subject_name'];
        //     //     $temp['exam_subject_code'] = $exam['exam_subject_code'];
        //     //     $temp['exam_dept'] = $exam['exam_dept'];
        //     //     $temp['exam_batch'] = $exam['batchyear'];
        //     //     $temp['exam_start_time'] = $exam['exam_start_time'];
        //     //     $temp['exam_end_time'] = $exam['exam_end_time'];
        //     //     $temp['exam_capacity'] = $exam['exam_capacity'];

        //     //     array_push($halls,$temp);
        //     // }
        // } else {
        //     $query = "SELECT tbl_room.*, tbl_department.deptname as deptname, tbl_block.block as blockname FROM tbl_room INNER JOIN tbl_department ON tbl_room.dept=tbl_department.id INNER JOIN tbl_block ON tbl_room.block=tbl_block.id;";
        //     $query_run = mysqli_query($conn, $query);
        //     if (mysqli_num_rows($query_run) > 0) {
        //         foreach ($query_run as $hall) {
        //             $temp['roomid'] = $hall['id'];
        //             $temp['roomdept'] = $hall['dept'];
        //             $temp['deptname'] = $hall['deptname'];
        //             $temp['roomblock'] = $hall['block'];
        //             $temp['blockname'] = $hall['blockname'];
        //             $temp['roomname'] = $hall['room'];
        //             $temp['roomcapacity'] = $hall['capacity'];

        //             array_push($halls, $temp);
        //         }
        //     }
        // }
        echo json_encode([
            "success" => true,
            "halls" => $halls
        ]);
    } else {
        echo json_encode([
            "success" => false
        ]);
    }
}

if (isset($_POST['save_halls'])) {
    $hall_date = $_POST['exam_date'];
    $hall_date = date("Y-m-d", strtotime($hall_date));

    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    $exam_details = $_POST['exam_details'];
    // print_r($exam_details);
    // print_r("<br>");

    $exam_halls = $_POST['exam_halls'];

    $exams = [];
    $halls = [];
    $students = [];
    $total_capacity = 0;


    for ($i = 0; $i < count($exam_details); $i++) {
        $query = "SELECT * FROM tbl_exams WHERE id='" . $exam_details[$i] . "'";
        $query_run = mysqli_query($conn, $query);
        if (mysqli_num_rows($query_run) > 0) {
            foreach ($query_run as $exam) {
                $temp['exam_id'] = $exam['id'];
                $temp['exam_dept'] = $exam['exam_dept'];
                $temp['exam_batch'] = $exam['exam_batch'];
                // $temp['exam_capacity'] = $exam['exam_capacity'];

                $query = "SELECT * FROM tbl_student WHERE student_department='" . $exam['exam_dept'] . "' AND student_batch='" . $exam['exam_batch'] . "' ORDER BY tbl_student.regno ASC";
                $query_run_2 = mysqli_query($conn, $query);
                if (mysqli_num_rows($query_run_2) > 0) {
                    $temp['exam_capacity'] = mysqli_num_rows($query_run_2);
                    $total_capacity += $temp['exam_capacity'];
                    
                } else {
                    $temp['exam_capacity'] = 0;
                }

                $t = [];
                foreach ($query_run_2 as $student) {
                    array_push($t, $student['id']);
                }

                array_push($students, $t);
                array_push($exams, $temp);
                // echo "<br><br>";
            }
        }
    }

    // print_r($students);
    // echo "<br><br>";
    $hall_query = [];

    for ($i = 0; $i < count($exam_halls); $i++) {
        // $query = "SELECT * FROM tbl_room WHERE id='".$exam_halls[$i]."'";
        $query = "SELECT tbl_room.*, if((tbl_halls.remaining is null OR tbl_halls.remaining=0), tbl_room.capacity, tbl_halls.remaining) as avail_capacity, tbl_department.deptname as deptname, tbl_block.block as blockname FROM tbl_room LEFT JOIN tbl_halls ON tbl_room.id = tbl_halls.room INNER JOIN tbl_department ON tbl_room.dept = tbl_department.id INNER JOIN tbl_block ON tbl_room.block=tbl_block.id WHERE tbl_room.id='" . $exam_halls[$i] . "';";
        $query_run = mysqli_query($conn, $query);
        if (mysqli_num_rows($query_run) > 0) {
            foreach ($query_run as $hall) {
                $t['hall_capacity'] = $hall['avail_capacity'];

                $r = $total_capacity - $hall['avail_capacity'];
                if ($r >= 0) {
                    $allocated = $hall['avail_capacity'];
                    $remain = $hall['avail_capacity'] - $allocated;
                } else {
                    $allocated = $total_capacity;
                    $remain = $hall['avail_capacity'] - $allocated;
                }

                $total_capacity = $r;

                array_push($hall_query, "INSERT INTO tbl_halls (date, start_time, end_time, room, exam_details, allocated, remaining) VALUES('" . $hall_date . "', '" . $start_time . "', '" . $end_time . "', " . $hall['id'] . ", '" . json_encode($exams) . "', " . $allocated . ", " . $remain . ");");
                
                array_push($halls, $t);
            }
        }
    }
    
    $total_query = count($hall_query);
    
    // echo "<br><br>";
    // print_r($hall_query);
    // echo "<br><br>";
    $k = 0;
    $stud_pos = [];
    $seating_query = [];
    foreach ($hall_query as $query) {
        $query_run = mysqli_query($conn, $query);
        if ($query_run) {
            $insert_id = mysqli_insert_id($conn);

            $allocated = 0;
            $cur_exams = [];
            $step = 0;

            $query_2 = "SELECT exam_details, allocated FROM tbl_halls WHERE tbl_halls.id='".$insert_id."'";
            $query_run_2 = mysqli_query($conn, $query_2);
            if ($query_run_2) {
                foreach($query_run_2 as $d) {
                    $allocated = $d['allocated'];
                    $c_exam = json_decode($d['exam_details']);
                    foreach ($c_exam as $ce) {
                        array_push($cur_exams, $ce->exam_id);
                        array_push($stud_pos, 0);
                    }
                }
                $step = count($cur_exams);
            }

            // print_r($cur_exams);
            // print_r($stud_pos);
            // print_r($step);
            // echo "<br>";
            for ($i=0; $i<$allocated; $i++) {
                if ($k == $step) {
                    $k=0;
                }
                array_push($seating_query, "INSERT INTO tbl_hall_student (hall_id, exam_id, s_id) VALUES (" . $insert_id . " , " . $cur_exams[$k] . ", " . $students[$k][$stud_pos[$k]] . ");");
                // echo $insert_id . " " . $cur_exams[$k] . " " . $students[$k][$stud_pos[$k]] . " " . $i . '<br>';
                $stud_pos[$k] = $stud_pos[$k] + 1;
                $k++;

            }
            // echo "<br>";
        }
    }

    foreach ($seating_query as $query) {
        mysqli_query($conn, $query);
    }

    // echo "<br><br>";
    // echo "updates";
    // echo "<br><br>";

    $j = 0;
    foreach ($exam_details as $detail) {
        // $query_run = mysqli_query($conn, $query);
        // if ($query_run) {
            $query_update = "UPDATE tbl_exams SET status=1 WHERE id='" . $detail . "'";
            // print_r($query_update);
            $query_run = mysqli_query($conn, $query_update);
            if ($query_run) {
            }

            
        // }
    }



    // if ($j == $total_query) {
    //     $_SESSION['message'] = "Halls Added Successfully";
    //     header("Location: halls.php");
    //     exit(0);
    // } else {
    //     $_SESSION['message'] = "Hall Not Added";
    //     header("Location: hall_create_edit.php");
    //     exit(0);
    // }
}

if (isset($_POST['get_hall_data'])) {
    if (isset($_POST['id'])) {

        $id = $_POST['id'];
        $query = "SELECT tbl_halls.*, tbl_room.room, tbl_block.block FROM tbl_halls INNER JOIN tbl_room ON tbl_room.id=tbl_halls.room INNER JOIN tbl_block ON tbl_block.id=tbl_room.block WHERE tbl_halls.id='" . $id . "'";

        $halls = [];
        $query_run = mysqli_query($conn, $query);
        if (mysqli_num_rows($query_run) > 0) {
            foreach ($query_run as $hall) {
                $temp['exam_id'] = $hall['id'];
                $temp['date'] = $hall['date'];
                $temp['start_time'] = $hall['start_time'];
                $temp['end_time'] = $hall['end_time'];
                $temp['exam_details'] = json_decode($hall['exam_details']);
                $temp['room'] = $hall['room'];
                $temp['block'] = $hall['block'];
                $temp['exams'] = [];

                foreach ($temp['exam_details'] as $exam) {
                    $query = "SELECT tbl_exams.*, tbl_department.deptname as deptname, tbl_batch.batchyear as batchyear FROM tbl_exams INNER JOIN tbl_department ON tbl_department.id=tbl_exams.exam_dept INNER JOIN tbl_batch ON tbl_batch.id=tbl_exams.exam_batch WHERE tbl_exams.id=" . $exam->exam_id;

                    $query_run = mysqli_query($conn, $query);
                    if (mysqli_num_rows($query_run) > 0) {
                        foreach ($query_run as $exam) {

                            $query = "SELECT count(*) as student_strength FROM tbl_student WHERE student_department='" . $exam['exam_dept'] . "' AND student_batch='" . $exam['exam_batch'] . "';";
                            $query_run = mysqli_query($conn, $query);
                            if (mysqli_num_rows($query_run) > 0) {
                                $row = mysqli_fetch_assoc($query_run);
                                $t['strength'] = $row['student_strength'];
                            }
                            $t['exam_id'] = $exam['id'];
                            $t['exam_name'] = $exam['exam_name'];
                            $t['exam_subject_name'] = $exam['exam_subject_name'];
                            $t['exam_subject_code'] = $exam['exam_subject_code'];
                            $t['exam_start_time'] = $exam['exam_start_time'];
                            $t['exam_end_time'] = $exam['exam_end_time'];
                            $t['status'] = $exam['status'];
                            $t['deptname'] = $exam['deptname'];
                            $t['batchyear'] = $exam['batchyear'];
                        }

                        array_push($temp['exams'], $t);
                    }
                }

                array_push($halls, $temp);
            }
        }
        echo json_encode([
            "success" => true,
            "halls" => $halls
        ]);
    } else {
        echo json_encode([
            "success" => false
        ]);
    }
}

if (isset($_POST['get_invigilators'])) {
    if (isset($_POST['id'])) {

        $id = $_POST['id'];
        $query = "SELECT tbl_staff.id as staffid, tbl_staff.firstname, tbl_staff.lastname, tbl_department.deptname FROM tbl_staff INNER JOIN tbl_department ON tbl_department.id=tbl_staff.staff_department WHERE admin=0 AND active=1 ORDER BY tbl_department.deptname, tbl_staff.firstname ASC";
        $staffs = [];

        $query_run = mysqli_query($conn, $query);
        if (mysqli_num_rows($query_run) > 0) {
            foreach ($query_run as $staff) {
                $temp['staff_id'] = $staff['staffid'];
                $temp['firstname'] = $staff['firstname'];
                $temp['lastname'] = $staff['lastname'];
                $temp['deptname'] = $staff['deptname'];

                array_push($staffs, $temp);
            }
        }
        echo json_encode([
            "success" => true,
            "staffs" => $staffs
        ]);
    } else {
        echo json_encode([
            "success" => false
        ]);
    }
}

if (isset($_POST['assign_invigilator'])) {
    if (isset($_POST['hall_id']) && isset($_POST['assign_staff'])) {
        $hall_id = $_POST['hall_id'];
        $staff_id = $_POST['assign_staff'];

        $query = "UPDATE tbl_halls SET staff=" . $staff_id . " WHERE id='" . $hall_id . "'";
        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
            $_SESSION['message'] = "Staff Added Successfully";
            header("Location: halls.php");
            exit(0);
        } else {
            $_SESSION['message'] = "Staff Not Added";
            header("Location: halls.php");
            exit(0);
        }
    }
}

if (isset($_POST['student_sheet_pdf_maker'])) {
    
        $exam_id = $_POST['student_sheet_pdf_maker'];

        // $exam_details = [];

        $exam_name      = '';
        $exam_subject_name      = '';
        $exam_subject_code      = '';
        $exam_date              = '';
        $exam_start_time        = '';
        $exam_end_time          = '';
        $exam_dept              = 0;
        $exam_batch             = 0;

        
        // $query = "SELECT tbl_halls.id as hall_id, tbl_halls.*, tbl_room.id as room_id, tbl_room.*, tbl_department.deptname, tbl_block.block FROM tbl_halls INNER JOIN tbl_room ON tbl_room.id=tbl_halls.room INNER JOIN tbl_department ON tbl_department.id=tbl_room.dept INNER JOIN tbl_block ON tbl_block.id=tbl_room.block WHERE tbl_halls.id='".$hall_id."'";
        $query = "SELECT tbl_exams.* FROM tbl_exams WHERE tbl_exams.id='".$exam_id."'";

        $query_run = mysqli_query($conn, $query);
        if (mysqli_num_rows($query_run) > 0) {
            foreach ($query_run as $exam) {
                $exam_name      = $exam['exam_name'];
                $exam_subject_name      = $exam['exam_subject_name'];
                $exam_subject_code      = $exam['exam_subject_code'];
                $exam_date              = $exam['exam_date'];
                $exam_start_time        = $exam['exam_start_time'];
                $exam_end_time          = $exam['exam_end_time'];
                $exam_dept              = $exam['exam_dept'];
                $exam_batch             = $exam['exam_batch'];

            }
        }

        $students = [];
        if ($exam_dept != 0 && $exam_batch != 0) {
            $query = "SELECT * FROM tbl_student WHERE student_department='".$exam_dept."' AND student_batch='".$exam_batch."' ORDER BY tbl_student.regno ASC";
            $query_run = mysqli_query($conn, $query);
            if (mysqli_num_rows($query_run) > 0) {
                foreach ($query_run as $student) {
                    $t = [];
                    $t['regno'] = $student['regno'];
                    $t['student_name'] = $student['firstname'] . ' ' . $student['lastname'];
                    array_push($students, $t);
                }
            }
        }


        //----- Code for generate pdf
        $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        //$pdf->SetTitle("Export HTML Table data to PDF using TCPDF in PHP");  
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

        // $header = '
        //     <div align="center">
        //         <h3>Dr. N.G.P. Arts and Science College</h3>
        //         <span>(An Autonomous Institution, Affiliated to Bharathiar University,Coimbatore)</span><br>
        //         <span>Webset: www.drngpasc.ac.in | Email: info@drngpasc.ac.in | Contact: 8745962103</span>
        //     </div>
        // ';
        // $pdf->writeHTML($header);

        $info_right_column = '';
        $info_left_column  = '';

        // $info_right_column .= '<span style="font-weight:bold;font-size:14px;">' . 'ROOM : ' . $exam_details['exam_name'] . '</span><br />';
        // $info_right_column .= '<b style="color:#4e4e4e;">DATE : ' . $exam_details['exam_date'] . '</b><br>';
        // $info_right_column .= '<b style="color:#4e4e4e;">TIME : ' . $exam_details['exam_start_time'] . ' to ' . $exam_details['exam_end_time'] . '</b>';
        // $info_right_column .= $exam_details[0];

        $image_file = '../assets/images/logo.jpg';
        $pdf->Image($image_file, 10, 10, 190, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        pdf_multi_row($info_left_column, $info_right_column, $pdf, ($dimensions['wk'] / 2) - $dimensions['lm']);

        $pdf->ln(10);

        $pdf->writeHTML('<br><br><br><br><br>');

        $pdf->writeHTML('<h4 align="center">'.$exam_name.'</h4>');
        $pdf->writeHTML('<h4 align="center">'.$exam_subject_name . ' ' . $exam_subject_code.'</h4>');
        $pdf->writeHTML('<h4 align="center"> Date : ' . $exam_date . '(' . $exam_start_time . ' to ' . $exam_end_time .')</h4>');

        $content = '<br><br><br>';
        $content .= '<table border="1" cellspacing="0" cellpadding="10">
        <tr>
        <th width="10%"><b>SN</b></th>
        <th width="40%"><b>RegNo</b></th>
        <th width="50%"><b>Student Name</b></th>
        </tr>';

        $i = 1;
        foreach ($students as $student ){ 
            $content .= '<tr>';
            $content .= '<td>'.$i.'</td>';
            foreach ($student as $key) {
                $content .= '<td>' . $key . '</td>';
            }
            $i += 1;
            // $content .= '<td></td>';
            $content .= '</tr>';
        }
        
        $content .= '</table>';
        $pdf->writeHTML($content);


        $pdf->writeHTML('<br><br><br><br><br>');

        $pdf->writeHTML('<h4 align="left">Invigilator Signature</h4>');
        $pdf->writeHTML('<h4 align="right">HOD Signature</h4>');

        // $file_location = "/home/fbi1glfa0j7p/public_html/examples/generate_pdf/uploads/"; //add your full path of your server
        $file_location = "C://xampp/htdocs/examcell/uploads/"; //for local xampp server

        $datetime = date('dmY_hms');
        $file_name = "HSA_" . $datetime . ".pdf";
        ob_end_clean();

        // $action = $_GET['ACTION'];
        $action = 'view';

        if ($action == 'view') {
            $pdf->Output($file_name, 'I'); // I means Inline view
        } else if ($action == 'download') {
            $pdf->Output($file_name, 'D'); // D means download
        } else if ($action == 'upload') {
            $pdf->Output($file_location . $file_name, 'F'); // F means upload PDF file on some folder
            echo "Upload successfully!!";
        }

        //----- End Code for generate pdf

}

if (isset($_POST['seating_pdf_maker'])) {
    
    $hall_id = $_POST['seating_pdf_maker'];

    $hall_details = [];
    $exam_details = [];
    $query = "SELECT tbl_halls.id as hall_id, tbl_halls.*, tbl_room.id as room_id, tbl_room.*, tbl_department.deptname, tbl_block.block FROM tbl_halls INNER JOIN tbl_room ON tbl_room.id=tbl_halls.room INNER JOIN tbl_department ON tbl_department.id=tbl_room.dept INNER JOIN tbl_block ON tbl_block.id=tbl_room.block WHERE tbl_halls.id='".$hall_id."'";

    $query_run = mysqli_query($conn, $query);
    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $hall) {
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
        }
    }

    // Get Exam Details on a Room
    $hall_details['exam_details'][0]->exam_id;

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
    $query = "SELECT tbl_hall_student.*, tbl_student.regno FROM tbl_hall_student INNER JOIN tbl_student ON tbl_student.id=tbl_hall_student.s_id WHERE hall_id = '".$hall_id."' ORDER BY tbl_hall_student.id ASC;";
    $query_run = mysqli_query($conn, $query);
    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $stud) {
            array_push($students, $stud['regno']);
        }
    }

    //----- Code for generate pdf
    $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetCreator(PDF_CREATOR);
    //$pdf->SetTitle("Export HTML Table data to PDF using TCPDF in PHP");  
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

    $header = '
        <div align="center">
            <h3>ABC college</h3>
            <span>Madurai 625-015, Tamilnadu, India</span><br>
            <span>Email: examcell.admin@tce.edu Contact: 8745962103</span>
        </div>
    ';
    $pdf->writeHTML($header);
    
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

    // $action = $_GET['ACTION'];
    $action = 'view';

    if ($action == 'view') {
        $pdf->Output($file_name, 'I'); // I means Inline view
    } else if ($action == 'download') {
        $pdf->Output($file_name, 'D'); // D means download
    } else if ($action == 'upload') {
        $pdf->Output($file_location . $file_name, 'F'); // F means upload PDF file on some folder
        echo "Upload successfully!!";
    }

    //----- End Code for generate pdf

}


/**
 * Helper function for PDF multi row
 * @param  string  $left       the left row
 * @param  string  $right      the right row
 * @param  object  $pdf        the PDF class object
 * @param  integer $left_width left row width
 * @return null
 */
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