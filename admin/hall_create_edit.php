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
                        <h4><?php echo isset($_GET['id']) ? 'Edit' : 'Allocate'; ?> Hall</h4>
                    </div>
                    <div class="col-md-4">
                        <a href="halls.php" class="btn btn-success rounded float-end">Back</a>
                    </div>
                </div>
                <hr>
                <?php include '../helpers/message.php'; ?>
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
                    <form action="controller.php" method="POST" class="p-3 hall_management">
                        <?php if (isset($_GET['id'])) { ?>
                            <input type="text" class="form-control visually-hidden" id="id" name="id" value="<?php echo isset($exam['id']) ? $exam['id'] : ''; ?>">
                        <?php } ?>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="exam_date" class="form-label">Exam Date</label>
                                    <input type="text" id="exam_date" class="form-control datepicker" name="exam_date" autofocus>
                                    <input type="text" id="start_time" class="form-control timepicker visually-hidden" name="start_time" >
                                    <input type="text" id="end_time" class="form-control timepicker visually-hidden" name="end_time" >
                                </div>
                            </div>
                            <div class="col-md-8 text-end">
                                <label class="text-danger fw-bolder" for="hall_red_seats">NEEDED</label> <span class="badge bg-danger seats_needed">0</span><br>
                                <label class="text-success fw-bolder" for="hall_green_seats">SEATED</label> <span class="badge bg-success seats_allotted">0</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Select Exams</h5>
                                <hr>
                            </div>
                            <div class="col-md-6">
                                <h5>Select Halls</h5>
                                <hr>
                            </div>
                        </div>

                        <div class="row"> 
                            <div class="col-md-6 exam_details">
                                
                            </div>
                            <!-- <div class='col-md-1'>
                                <button type='button' class='filter_halls btn btn-primary btn-sm'><i class="fa fa-forward" aria-hidden="true"></i></button>
                            </div> -->
                            <div class="col-md-6 hall_details">
                                
                            </div>
                            <!-- <div class='col-md-1'>
                                <button type='button' class='btn btn-primary btn-sm'><i class="fa fa-forward" aria-hidden="true"></i></button>
                            </div> -->
                        </div>

                        <button type="submit" name="<?php echo isset($exam['id']) ? '' : 'save_halls'; ?>" class="btn btn-primary">Save</button>
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
