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
                        <h4><?php echo isset($_GET['id']) ? 'Edit' : 'Set'; ?> Exam</h4>
                    </div>
                    <div class="col-md-4">
                        <a href="exams.php" class="btn btn-success rounded float-end">Back</a>
                    </div>
                </div>
                <hr>
                <?php include 'message.php'; ?>
                <div>
                    <?php
                    if (isset($_GET['id'])) {
                        $exam_id = mysqli_real_escape_string($conn, $_GET['id']);
                        $query = "SELECT * FROM tbl_exams WHERE id='$exam_id' ";
                        $query_run = mysqli_query($conn, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            $exam = mysqli_fetch_array($query_run);
                        }
                    }
                    ?>
                    <form action="controller.php" method="POST" class="p-3" id="exam_form">
                        <?php if (isset($_GET['id'])) { ?>
                            <input type="text" class="form-control visually-hidden" id="id" name="id" value="<?php echo isset($exam['id']) ? $exam['id'] : ''; ?>">
                        <?php } ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exam_name" class="form-label">Exam Name</label>
                                    <input type="text" class="form-control" id="exam_name" name="exam_name" value="<?php echo isset($exam['exam_name']) ? $exam['exam_name'] : ''; ?>" required autofocus>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exam_dept" class="form-label">Department</label>
                                    <select class="form-select" name="exam_dept" id="exam_dept" aria-label="Default select example" required>
                                        <option selected>Select Department</option>
                                        <?php
                                        $query = "SELECT * FROM tbl_department";
                                        $query_run = mysqli_query($conn, $query);

                                        if (mysqli_num_rows($query_run) > 0) {
                                            foreach ($query_run as $department) {
                                                $selected = '';
                                                if (isset($_GET['id'])) {
                                                    if ($department['id'] == $exam['exam_dept']) {
                                                        $selected = 'selected';
                                                    }
                                                }
                                                echo "<option value='" . $department['id'] . "' data-deptslug='" . $department['deptslug'] . "' " . $selected . ">" . $department['deptname'] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exam_subject_name" class="form-label">Subject Name</label>
                                    <input type="text" class="form-control" id="exam_subject_name" name="exam_subject_name" value="<?php echo isset($exam['exam_subject_name']) ? $exam['exam_subject_name'] : ''; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exam_subject_code" class="form-label">Subject Code</label>
                                    <input type="text" class="form-control" id="exam_subject_code" name="exam_subject_code" value="<?php echo isset($exam['exam_subject_code']) ? $exam['exam_subject_code'] : ''; ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="exam_date" class="form-label">Exam Date</label>
                                    <input type="text" id="exam_date" class="form-control datepicker" name="exam_date" value="<?php echo isset($exam['exam_date']) ? $exam['exam_date'] : ''; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="exam_start_time" class="form-label">Start Time</label>
                                    <input type="text" id="exam_start_time" class="form-control timepicker" name="exam_start_time" value="<?php echo isset($exam['exam_start_time']) ? $exam['exam_start_time'] : ''; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="exam_end_time" class="form-label">End Time</label>
                                    <input type="text" id="exam_end_time" class="form-control timepicker" name="exam_end_time" value="<?php echo isset($exam['exam_end_time']) ? $exam['exam_end_time'] : ''; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="exam_batch" class="form-label">Batch</label>
                            <select class="form-select" name="exam_batch" id="exam_batch" aria-label="Default select example" required>
                                <option selected>Select Batch</option>
                                <?php
                                    if (isset($_GET['id'])) {
                                        $query = 'SELECT * FROM tbl_batch WHERE dept="'.$exam['exam_dept'].'"';
                                        $query_run = mysqli_query($conn, $query);
                                        if (mysqli_num_rows($query_run) > 0) {
                                            foreach ($query_run as $batch) {
                                                print_r($batch);
                                                $selected = '';
                                                if ($batch['id'] == $exam['exam_batch']) {
                                                    $selected = ' selected';
                                                }
                                                echo "<option value='".$batch['id']."'".$selected.">".$batch['batchyear']."</option>";
                                            }
                                        }
                                    }
                                ?>
                            </select>
                        </div>

                        <?php if (isset($_GET['id'])) {
                            $statuses = ['Not Seated', 'Seated', 'Ongoing', 'Completed'];
                            ?>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" name="status" id="status" aria-label="Default select example" required>
                                    <?php foreach ($statuses as $status) {
                                        $selected = '';
                                        if (array_search($status, $statuses) == $exam['status']) {
                                            $selected = 'selected';
                                        }
                                        echo "<option value='".array_search($status, $statuses)."' ".$selected.">".$status."</option>";
                                    } ?>
                                </select>
                            </div>
                        <?php } ?>

                        <button type="submit" name="<?php echo isset($exam['id']) ? 'update_exam' : 'save_exam'; ?>" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php
    echo site_footer();
} else {
    header("Location: index.php");
}
