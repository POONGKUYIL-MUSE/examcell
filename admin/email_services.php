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
                        <h4>Manage Email Services</h4>
                    </div>
                    <div class="col-md-4">
                        <a href="email_service_create_edit.php" class="btn btn-success rounded float-end">Add Service</a>
                    </div>
                </div>
                <div>
                    <hr>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Email</th>
                                <th>Properties</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM tbl_email_service";
                            $query_run = mysqli_query($conn, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $email_service) {
                            ?>
                                    <tr>
                                        <td><?= $email_service['id']; ?></td>
                                        <td><?= $email_service['email']; ?></td>
                                        <td>
                                            <?php
                                                $properties = json_decode($email_service['properties']);
                                                echo "Username : " . $properties->email_username;
                                                echo "<br>Host : " . $properties->email_host;
                                                echo "<br>Secure : " . $properties->email_secure;
                                                echo "<br>Port : " . $properties->email_port;
                                                echo "<br>Password : " . $properties->password;
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                $statuses = ["-1" => "Suspend", "0" => 'Rest', "1" => "Active"];
                                                echo $statuses[$email_service['status']];
                                            ?>
                                        </td>
                                        <td>
                                            <a href="email_service_create_edit.php?id=<?= $email_service['id']; ?>" class="btn btn-info btn-sm">Edit</a>
                                            <form action="controller.php" method="POST" class="d-inline">
                                                <button type="submit" name="delete_email_service" value="<?= $email_service['id']; ?>" class="btn btn-danger btn-sm">Delete</button>
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
