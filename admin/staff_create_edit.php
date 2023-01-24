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
                            <h4><?php echo isset($_GET['id'])?'Edit':'Add'; ?> Staff</h4>
                    </div>
                    <div class="col-md-4">
                        <a href="staff.php" class="btn btn-success rounded float-end">Back</a>
                    </div>
                </div>
                <hr>
                <?php include 'message.php'; ?>
                <div>
                <?php
                        if(isset($_GET['id']))
                        {
                            $staff_id = mysqli_real_escape_string($conn, $_GET['id']);
                            $query = "SELECT * FROM tbl_staff WHERE id='$staff_id' ";
                            $query_run = mysqli_query($conn, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $staff = mysqli_fetch_array($query_run);
                            }
                        }
                        ?>  
                    <form action="controller.php" method="POST" class="p-3">
                        <?php if (isset($_GET['id'])) { ?>
                            <input type="text" class="form-control visually-hidden" id="id" name="id" value="<?php echo isset($staff['id'])?$staff['id']:''; ?>">
                        <?php }?>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($staff['email'])?$staff['email']:''; ?>" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="firstname" class="form-label">Firstname</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo isset($staff['firstname'])?$staff['firstname']:''; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="lastname" class="form-label">Lastname</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo isset($staff['lastname'])?$staff['lastname']:''; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="phonenumber" class="form-label">Phonenumber</label>
                            <input type="text" class="form-control" id="phonenumber" name="phonenumber" value="<?php echo isset($staff['phonenumber'])?$staff['phonenumber']:''; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="staff_department" class="form-label">Department</label>
                            <select class="form-select" name="staff_department" id="staff_department" aria-label="Default select example">
                                <option selected>Select Department</option>
                                <?php 
                                    $query = "SELECT * FROM tbl_department";
                                    $query_run = mysqli_query($conn, $query);
        
                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach ($query_run as $department) {
                                            $selected = '';
                                            if (isset($_GET['id'])) {
                                                if ($department['id'] == $staff['staff_department']) {
                                                    $selected = 'selected';
                                                }
                                            }
                                            echo "<option value='".$department['id']."' data-deptslug='".$department['deptslug']."' ".$selected.">".$department['deptname']."</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" <?php echo isset($staff['id'])?'':'required'?>>
                        </div>
                        <button type="submit" name="<?php echo isset($staff['id'])?'update_staff':'save_staff'; ?>" class="btn btn-primary">Save</button>
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
