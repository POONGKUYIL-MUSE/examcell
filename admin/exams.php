<?php
session_start();
include '../helpers/basic_helper.php';

if (isset($_SESSION['email']) && isset($_SESSION['id'])) {
    echo site_header();
?>

    <div class="container-fluid">
        <div class="row flex-nowrap">
            <?php echo site_navbar(); ?>
            <div class="after-side-content col py-5 px-5">
                <div class="row">
                    <div class="col-md-8">
                            <h4>Manage Exams</h4>
                    </div>
                    <div class="col-md-4">
                        <a href="exam_create_edit.php" class="btn btn-success rounded float-end">Set Exam</a>
                    </div>
                </div>
                <div>
                    <hr>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Exam Type/Subject</th>
                                <th>Batch</th>
                                <th>Datetime</th>
                                <th>Strength</th>
                                <th>Status</th>
                                <th width="15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $query = "SELECT tbl_exams.*, tbl_department.deptname AS deptname, tbl_batch.batchyear AS batchyear FROM tbl_exams INNER JOIN tbl_department ON tbl_exams.exam_dept = tbl_department.id INNER JOIN tbl_batch ON tbl_exams.exam_batch = tbl_batch.id ORDER BY tbl_exams.exam_date DESC, tbl_exams.id ASC;";
                            $query_run = mysqli_query($conn, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $exam) {
                            ?>
                                    <tr>
                                        <td><small><?= $exam['id']; ?></small></td>
                                        <td>
                                            <small>
                                                <?= $exam['exam_name']; ?><br>
                                                <?= '(' . $exam['exam_subject_name'] . ' - ' . $exam['exam_subject_code'] . ')'; ?>
                                            </small>
                                        </td>
                                        <td>
                                            <small><?= $exam['deptname'] . ' ' . $exam['batchyear']; ?></small>
                                        </td>
                                        <td>
                                            <small><?= $exam['exam_date'] . ' (' . $exam['exam_start_time'] . ' to ' . $exam['exam_end_time'] . ')'; ?></small>
                                        </td>
                                        <td>
                                            <small>
                                            <?php
                                                $query = "SELECT count(*) as student_strength FROM tbl_student WHERE student_department='".$exam['exam_dept']."' AND student_batch='".$exam['exam_batch']."';";
                                                $query_run = mysqli_query($conn, $query);

                                                if (mysqli_num_rows($query_run) > 0) {
                                                    $row = mysqli_fetch_assoc($query_run);
                                                    echo "(" . $row['student_strength'] . ")";
                                                }
                                            ?>
                                            </small>
                                        </td>
                                        <td>
                                            <small>
                                            <?php
                                                $statuses = ['Not Seated', 'Seated', 'Ongoing', 'Completed'];
                                                $classess = ['bg-secondary', 'bg-primary', 'bg-info', 'bg-success'];

                                                echo '<span class="text-white badge '.$classess[$exam['status']].'">' . $statuses[$exam['status']] . '</span>';

                                                if ($exam['is_notified'] != null) {
                                                    echo " | <i data-bs-toggle='tooltip' title='".$exam['is_notified']."' class='fa fa-calendar-check-o' aria-hidden='true'></i>";
                                                }

                                                if ($exam['event_id'] != 0) {
                                                    echo ' | Event Created';
                                                }
                                            ?>
                                            </small>
                                        </td>
                                        <td>
                                            <a href="exam_create_edit.php?id=<?= $exam['id']; ?>" class="btn btn-info btn-sm">Edit</a>
                                            <form action="controller.php" method="POST" class="d-inline">
                                                <button type="submit" name="student_sheet_pdf_maker" value="<?= $exam['id']; ?>" class="btn btn-info btn-sm">PDF</button>
                                            </form><br>
                                            <?php if ($exam['status'] == 1 && $exam['event_id']==0) { ?>
                                                <form action="controller.php" method="POST" class="d-inline">
                                                    <button type="submit" name="exam_set_event" value="<?= $exam['id']; ?>" class="btn btn-warning btn-sm mt-1">SET EVENT</button>
                                                </form>
                                            <?php } ?>
                                            <form action="controller.php" method="POST" class="d-inline">
                                                <button type="submit" name="delete_exam" value="<?= $exam['id']; ?>" class="btn btn-danger btn-sm mt-1">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<h5> No Record Found </h5>";
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
