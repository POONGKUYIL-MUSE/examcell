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
                            <h4><?php echo isset($_GET['id'])?'Edit':'Add'; ?> Student</h4>
                    </div>
                    <div class="col-md-4">
                        <a href="student.php" class="btn btn-success rounded float-end">Back</a>
                    </div>
                </div>
                <hr>
                <?php include 'message.php'; ?>
                <div>
                <?php
                        if(isset($_GET['id']))
                        {
                            $student_id = mysqli_real_escape_string($conn, $_GET['id']);
                            $query = "SELECT * FROM tbl_student WHERE id='$student_id' ";
                            $query_run = mysqli_query($conn, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $student = mysqli_fetch_array($query_run);
                            }
                        }
                        ?>  
                    <form action="controller.php" method="POST" class="p-3" id="student_form">
                        <?php if (isset($_GET['id'])) { ?>
                            <input type="text" class="form-control visually-hidden" id="id" name="id" value="<?php echo isset($student['id'])?$student['id']:''; ?>">
                        <?php }?>
                        <div class="row mb-1">
                            <div class="col-md-6">
                                <label for="regno" class="form-label">Register Number</label>
                                <input type="text" class="form-control" id="regno" name="regno" value="<?php echo isset($student['regno'])?$student['regno']:''; ?>" autofocus required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($student['email'])?$student['email']:''; ?>" required>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-6">
                                <label for="firstname" class="form-label">Firstname</label>
                                <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo isset($student['firstname'])?$student['firstname']:''; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="lastname" class="form-label">Lastname</label>
                                <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo isset($student['lastname'])?$student['lastname']:''; ?>" required>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-6">
                                <label for="student_department" class="form-label">Department</label>
                                <select class="form-select" name="student_department" id="student_department" aria-label="Default select example" required>
                                    <option selected>Select Department</option>
                                    <?php 
                                        $query = "SELECT * FROM tbl_department";
                                        $query_run = mysqli_query($conn, $query);
            
                                        if(mysqli_num_rows($query_run) > 0)
                                        {
                                            foreach ($query_run as $department) {
                                                $selected = '';
                                                if (isset($_GET['id'])) {
                                                    if ($department['id'] == $student['student_department']) {
                                                        $selected = 'selected';
                                                    }
                                                }
                                                echo "<option value='".$department['id']."' data-deptslug='".$department['deptslug']."' ".$selected.">".$department['deptname']."</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="student_batch" class="form-label">Batch</label>
                                <select class="form-select" name="student_batch" id="student_batch" aria-label="Default select example" required>
                                    <option selected>Select Batch</option>
                                    <?php 
                                        if (isset($_GET['id'])) {
                                            $dept = $student['student_department'];
                                            $query = "SELECT * FROM tbl_batch WHERE dept='$dept'";
                                            $query_run = mysqli_query($conn, $query);
                
                                            if(mysqli_num_rows($query_run) > 0)
                                            {
                                                foreach ($query_run as $batch) {
                                                    $selected = '';
                                                    if (isset($_GET['id'])) {
                                                        if ($batch['id'] == $student['student_batch']) {
                                                            $selected = 'selected';
                                                        }
                                                    }
                                                    echo "<option value='".$batch['id']."' ".$selected.">".$batch['batchyear']."</option>";
                                                }
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-6">
                                <label for="phonenumber" class="form-label">Phonenumber</label>
                                <input type="text" class="form-control" id="phonenumber" name="phonenumber" value="<?php echo isset($student['phonenumber'])?$student['phonenumber']:''; ?>" required>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" <?php echo isset($student['id'])?'':'required'?>>
                            </div>
                        </div>
                        
                        <button type="submit" name="<?php echo isset($student['id'])?'update_student':'save_student'; ?>" class="btn btn-primary">Save</button>
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
