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
                            <h4>Manage Staff</h4>
                    </div>
                    <div class="col-md-4">
                        <a href="staff_create_edit.php" class="btn btn-success rounded float-end">Add Staff</a>
                    </div>
                </div>
                <div>
                    <hr>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Staff Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM tbl_staff";
                            $query_run = mysqli_query($conn, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $staff) {
                            ?>
                                    <tr>
                                        <td><?= $staff['id']; ?></td>
                                        <td><?= $staff['firstname'] . ' ' . $staff['lastname']; ?></td>
                                        <td><?= $staff['email']; ?></td>
                                        <td><?= $staff['phonenumber']; ?></td>
                                        <td><?= $staff['active']; ?></td>
                                        <td>
                                            <!-- <a href="staff-view.php?id=<?= $staff['id']; ?>" class="btn btn-info btn-sm">View</a> -->
                                            <a href="staff_create_edit.php?id=<?= $staff['id']; ?>" class="btn btn-info btn-sm">Edit</a>
                                            <form action="controller.php" method="POST" class="d-inline">
                                                <button type="submit" name="delete_staff" value="<?= $staff['id']; ?>" class="btn btn-danger btn-sm">Delete</button>
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
