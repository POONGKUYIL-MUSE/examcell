<?php
session_start();
include '../helpers/basic_helper.php';

$today = date('Y-m-d');

if (isset($_SESSION['email']) && isset($_SESSION['id'])) {
    echo site_header();

    $staff_id = $_SESSION['id'];
?>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <?php echo site_navbar(); ?>
            <div class="after-side-content col py-5 px-5">
                <?php
                    echo "<h4>Hi " . $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] . ' ...!</h4>';
                    echo "<hr>";
                    if ($_SESSION['admin']) { ?>
                        <button id="run_cron_manual" onclick="run_cron_manual();" type="button" class="float-end btn btn-warning"><i class="fa fa-bell" aria-hidden="true"></i> Manually Run CRON Job</button><br>
                        <hr>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>DateTime</th>
                                    <th>Room | Allocated</th>
                                    <th>Invigilator</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $query = "SELECT tbl_halls.*, tbl_room.room as roomname FROM tbl_halls INNER JOIN tbl_room ON tbl_room.id=tbl_halls.room WHERE tbl_halls.date='".$today."';";
                                $query_run = mysqli_query($conn, $query);
    
                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $hall) { ?>
                                    
                                    <tr>
                                        <td><small><?= $hall['date'] . ' (' . $hall['start_time'] . ' to ' . $hall['end_time'] . ')'; ?></small></td>
                                        <td><small><?= $hall['roomname']; ?> | Allocated - <?= $hall['allocated']; ?></small></td>
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
                                            }
                                            ?>
                                            </small>
                                        </td>                                    
                                        <td>
                                            <form action="controller.php" method="POST" class="d-inline">
                                                <button type="submit" name="hall_pdf_maker" value="<?= $hall['id']; ?>" class="btn btn-info btn-sm">PDF</button>
                                            </form>
                                        </td>
                                    </tr>

                                <?php }
                                } else {
                                    echo "<tr align='center'><td colspan='3'>No Records Found</td></tr>";
                                }
                            ?>
                            </tbody>
                        </table>
                    <?php } else { ?>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>DateTime</th>
                                    <th>Room | Allocated</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $query = "SELECT tbl_halls.*, tbl_room.room as roomname FROM tbl_halls INNER JOIN tbl_room ON tbl_room.id=tbl_halls.room WHERE tbl_halls.date='".$today."' AND tbl_halls.staff='".$staff_id."';";
                                $query_run = mysqli_query($conn, $query);
    
                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $hall) { ?>
                                    
                                    <tr>
                                        <td><small><?= $hall['date'] . ' (' . $hall['start_time'] . ' to ' . $hall['end_time'] . ')'; ?></small></td>
                                        <td><small><?= $hall['roomname']; ?> | Allocated - <?= $hall['allocated']; ?></small></td>                                        
                                        <td>
                                            <form action="controller.php" method="POST" class="d-inline">
                                                <button type="submit" name="hall_pdf_maker" value="<?= $hall['id']; ?>" class="btn btn-info btn-sm">PDF</button>
                                            </form>
                                        </td>
                                    </tr>

                                <?php }
                                } else {
                                    echo "<tr align='center'><td colspan='3'>No Records Found</td></tr>";
                                }
                            ?>
                            </tbody>
                        </table>

                    <?php }
                ?>
            </div>
        </div>
    </div>

<?php
    echo site_footer();
} else {
    header("Location: index.php");
}
