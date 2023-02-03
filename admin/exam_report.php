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
                        <h4>Exam Report - Department Wise Report</h4>
                    </div>
                    <div class="col-md-4">
                        <!-- <a href="hall_create_edit.php" class="btn btn-success rounded float-end">Allocate Hall</a> -->
                    </div>
                </div>
                <div>
                    <hr>
                    <form action="controller.php" method="POST" class="d-inline">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="exam_report_date" class="form-label">Exam Date</label>
                                <input type="text" id="exam_report_date" class="form-control datepicker" name="exam_report_date" autofocus>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-4">
                                <label for="exam_report_dept" class="form-label">Choose Department</label>
                                <select class="form-select" name="exam_report_dept" id="exam_report_dept" aria-label="Default select example">
                                    <option value="0" selected>Select Department</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                            <button type="submit" name="exam_report_download" value="true" class="btn btn-success" disabled>Download Report</button>
                            </div>
                        </div>
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
