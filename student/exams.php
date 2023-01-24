<?php
session_start();
include '../helpers/basic_helper.php';

if (isset($_SESSION['email']) && isset($_SESSION['id'])) {
    echo site_header();
?>

    <div class="container-fluid">
        <div class="row flex-nowrap">
            <?php echo student_site_navbar(); ?>
            <div class="after-side-content col py-5 px-5">
                <div class="row">
                    <div class="col-md-8">
                            <h4>Exams</h4>
                    </div>
                    <div class="col-md-4">
                        <!-- <a href="exam_create_edit.php" class="btn btn-success rounded float-end">Set Exam</a> -->
                    </div>
                </div>
                <div>
                    <hr>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Exam Type</th>
                                <th>Subject</th>
                                <th>Datetime</th>
                                <th>Hall</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                                $current_date = date('Y-m-d');

                                $query = "SELECT * FROM tbl_exams WHERE exam_dept='".$_SESSION['student_department']."' AND exam_batch='".$_SESSION['student_batch']."' AND exam_date>='".$current_date."'";
                                $query_run = mysqli_query($conn, $query);
                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $exam) {
                            ?>

                                <tr>
                                    <td><?= $exam['id']; ?></td>
                                    <td><?= $exam['exam_name']; ?></td>
                                    <td><?= $exam['exam_subject_code'] . ' - ' . $exam['exam_subject_name']; ?></td>
                                    <td><?= $exam['exam_date'] . '(' . $exam['exam_start_time'] . ' to ' . $exam['exam_end_time'] . ')'; ?></td>
                                    <td>
                                    <?php
                                        $query="SELECT tbl_room.room, tbl_block.block, tbl_department.deptname FROM tbl_hall_student INNER JOIN tbl_halls ON tbl_halls.id=tbl_hall_student.hall_id INNER JOIN tbl_room ON tbl_room.id=tbl_halls.room INNER JOIN tbl_block ON tbl_block.id=tbl_room.block INNER JOIN tbl_department ON tbl_department.id=tbl_block.dept WHERE tbl_hall_student.exam_id='".$exam['id']."' AND tbl_hall_student.s_id='".$_SESSION['id']."'";
                                        $query_run = mysqli_query($conn, $query);
                                        if (mysqli_num_rows($query_run) > 0) {
                                            $row = mysqli_fetch_array($query_run);
                                            echo $row['deptname'] . ' Dept.<br>Block : ' . $row['block'] . '<br>Room : ' . $row['room'];
                                        } else {
                                            echo "Not Seated";
                                        }
                                    ?>
                                    </td>
                                </tr>
                                  
                            <?php
                                    }
                                }
                            ?>
                        
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

<?php
    echo site_footer();
} else {
    header("Location: index.php");
}
