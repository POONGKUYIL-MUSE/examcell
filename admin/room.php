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
                            <h4>Manage Rooms</h4>
                    </div>
                    <div class="col-md-4">
                        <a href="room_create_edit.php" class="btn btn-success rounded float-end">Add Room</a>
                    </div>
                </div>
                <div>
                    <hr>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Room</th>
                                <th>Capacity</th>
                                <th>Department</th>
                                <th>Block</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT tbl_room.id as id, tbl_room.room, tbl_room.capacity, tbl_department.deptname, tbl_block.block FROM tbl_room INNER JOIN tbl_block ON tbl_block.id = tbl_room.block INNER JOIN tbl_department ON tbl_department.id = tbl_block.dept;";
                            $query_run = mysqli_query($conn, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $room) {
                            ?>
                                    <tr>
                                        <td><?= $room['id']; ?></td>
                                        <td><?= $room['room']; ?></td>
                                        <td><?= $room['capacity']; ?></td>
                                        <td><?= $room['deptname']; ?></td>
                                        <td><?= $room['block']; ?></td>
                                        <td>
                                            <a href="room_create_edit.php?id=<?= $room['id']; ?>" class="btn btn-info btn-sm">Edit</a>
                                            <form action="controller.php" method="POST" class="d-inline">
                                                <button type="submit" name="delete_room" value="<?= $room['id']; ?>" class="btn btn-danger btn-sm">Delete</button>
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
