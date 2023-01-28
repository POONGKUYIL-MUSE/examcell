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
                            <h4>Manage Student</h4>
                    </div>
                    <div class="col-md-4">
                        <!-- <button type="button" data-bs-toggle="dropdown" id="filter_button" class="btn btn-sm btn-secondary float-end mx-2 dropdown-toggle" aria-expanded="false"><i class="fa fa-filter" aria-hidden="true"></i></button> -->
                        <ul class="dropdown-menu" aria-labelledby="filter_button">
                            <li><hr class="dropdown-divider"></li>
                            <li><h6 class="dropdown-header">Departments</h6></li>
                            <li><hr class="dropdown-divider"></li>
                            <?php
                                $query = "SELECT * FROM tbl_department;";
                                $query_run = mysqli_query($conn, $query);

                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $dept) {
                            ?>
                                    <li><a class="dropdown-item filter_table" data-dept="<?= $dept['id'] ?>" href="#"><?= $dept['deptname']; ?></a></li>
                                <?php } 
                                } ?>
                        </ul>
                        <a href="student_create_edit.php" class="btn btn-success btn-sm rounded float-end">Add Student</a>
                    </div>
                </div>
                <div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <select class="form-select" name="student_department" id="student_department" aria-label="Default select example">
                                    <option value='0' selected>Filter By Department</option>
                                    <?php

                                        $query = "SELECT * FROM tbl_department";
                                        $query_run = mysqli_query($conn, $query);
            
                                        if(mysqli_num_rows($query_run) > 0)
                                        {
                                            foreach ($query_run as $department) {
                                                $selected = '';
                                                if (isset($_GET['dept'])) {
                                                    if ($department['id'] == $_GET['dept']) {
                                                        $selected = 'selected';
                                                    }
                                                }
                                                echo "<option value='".$department['id']."' data-deptslug='".$department['deptslug']."' ".$selected.">".$department['deptname']."</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <select class="form-select" name="student_batch" id="student_batch" aria-label="Default select example">
                                    <option value='0' selected>Filter By Batch</option>
                                    <?php 
                                        if (isset($_GET['dept'])) {
                                            $query = "SELECT * FROM tbl_batch WHERE dept='".$_GET['dept']."'";
                                            $query_run = mysqli_query($conn, $query);
                    
                                            if(mysqli_num_rows($query_run) > 0)
                                            {
                                                foreach ($query_run as $batch) {
                                                    $selected = '';
                                                    if (isset($_GET['batch'])) {
                                                        if ($batch['id'] == $_GET['batch']) {
                                                            $selected = 'selected';
                                                        }
                                                    }
                                                    echo "<option value='".$batch['id']."' ". $selected.">".$batch['batchyear']."</option>";
                                                }
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-secondary btn-sm filter-table">Filter</button>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>RegNo</th>
                                <th>Student Name</th>
                                <th>Contact</th>
                                <th>Department/Batch</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT tbl_student.*, tbl_department.deptname as deptname, tbl_batch.batchyear as batchyear FROM tbl_student INNER JOIN tbl_department ON tbl_student.student_department=tbl_department.id INNER JOIN tbl_batch ON tbl_student.student_batch=tbl_batch.id ORDER BY tbl_student.regno ASC";
                            if (isset($_GET['dept']) && isset($_GET['batch'])) {
                                $query = "SELECT tbl_student.*, tbl_department.deptname as deptname, tbl_batch.batchyear as batchyear FROM tbl_student INNER JOIN tbl_department ON tbl_student.student_department=tbl_department.id INNER JOIN tbl_batch ON tbl_student.student_batch=tbl_batch.id WHERE tbl_department.id='".$_GET['dept']."' AND tbl_batch.id='".$_GET['batch']."'  ORDER BY tbl_student.regno ASC";

                            }
                            $query_run = mysqli_query($conn, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $student) {
                            ?>
                                    <tr>
                                        <td><?= $student['regno']; ?></td>
                                        <td><?= $student['firstname'] . ' ' . $student['lastname']; ?></td>
                                        <td><?= $student['email'] . '<br>' . $student['phonenumber']; ?></td>
                                        <td><?= $student['deptname'] . '<br>' . $student['batchyear']; ?></td>
                                        <td><?= $student['active']; ?></td>
                                        <td>
                                            <!-- <a href="student-view.php?id=<?= $student['id']; ?>" class="btn btn-info btn-sm">View</a> -->
                                            <a href="student_create_edit.php?id=<?= $student['id']; ?>" class="btn btn-info btn-sm">Edit</a>
                                            <form action="controller.php" method="POST" class="d-inline">
                                                <button type="submit" name="delete_student" value="<?= $student['id']; ?>" class="btn btn-danger btn-sm">Delete</button>
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
