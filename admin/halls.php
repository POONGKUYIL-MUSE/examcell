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
                        <h4>Manage Halls</h4>
                    </div>
                    <div class="col-md-4">
                        <a href="hall_create_edit.php" class="btn btn-success rounded float-end">Allocate Hall</a>
                    </div>
                </div>
                <div>
                    <hr>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Room | Allocated</th>
                                <th>DateTime</th>
                                <th>Invigilator</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT tbl_halls.*, tbl_room.room as roomname FROM tbl_halls INNER JOIN tbl_room ON tbl_room.id=tbl_halls.room ORDER BY tbl_halls.date DESC;";
                            $query_run = mysqli_query($conn, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $hall) {
                            ?>
                                    <tr>
                                        <td><small><?= $hall['id']; ?></small></td>
                                        <td><small><?= $hall['roomname']; ?> | Allocated - <?= $hall['allocated']; ?></small></td>
                                        <td><small><?= $hall['date'] . ' (' . $hall['start_time'] . ' to ' . $hall['end_time'] . ')'; ?></small></td>
                                        <td><small><?php
                                            if ($hall['staff'] != NULL && $hall['staff'] != 0) {
                                                $query = "SELECT tbl_staff.firstname, tbl_staff.lastname, tbl_department.deptname FROM tbl_staff INNER JOIN tbl_department ON tbl_department.id=tbl_staff.staff_department WHERE tbl_staff.id=".$hall['staff'];
                                                $query_run = mysqli_query($conn, $query);
                                                if (mysqli_num_rows($query_run) > 0) {
                                                    $row = mysqli_fetch_assoc($query_run);
                                                    echo $row['firstname'] . ' ' . $row['lastname'] . '<br><small>(' . $row['deptname'] . ')</small><br>';
                                                    echo "<a href='#' class='assign_invigilator' data-hall_id='".$hall['id']."'>Change staff</a>";
                                                    if ($hall['is_notified'] != null) {
                                                        echo " | <i data-bs-toggle='tooltip' title='".$hall['is_notified']."' class='fa fa-calendar-check-o' aria-hidden='true'></i>";
                                                    }
                                                }
                                            } else {
                                                echo "<a href='#' class='btn btn-primary btn-sm assign_invigilator' data-hall_id='" . $hall['id'] . "'>Assign Staff</a>";
                                            }
                                            ?>
                                            </small>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-info btn-sm show_exam_detail" data-hall_id="<?= $hall['id']; ?>">View</a>
                                            <form action="controller.php" method="POST" class="d-inline">
                                                <button type="submit" name="hall_pdf_maker" value="<?= $hall['id']; ?>" class="btn btn-info btn-sm">PDF</button>
                                            </form>
                                            <form action="controller.php" method="POST" class="d-inline">
                                                <button type="submit" name="delete_exam" value="<?= $hall['id']; ?>" class="btn btn-danger btn-sm">Delete</button>
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

    <div class="modal fade" tabindex="-1" id="show_exam_detail" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
            </div>
        </div>
    </div>
    
    <div class="modal fade" tabindex="-1" id="assign_invigilator" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
            </div>
        </div>
    </div>

<?php
    echo site_footer();
} else {
    header("Location: index.php");
}
