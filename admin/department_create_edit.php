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
                            <h4><?php echo isset($_GET['id'])?'Edit':'Add'; ?> Department</h4>
                    </div>
                    <div class="col-md-4">
                        <a href="department.php" class="btn btn-success rounded float-end">Back</a>
                    </div>
                </div>
                <hr>
                <?php include '../helpers/message.php'; ?>
                <div>
                <?php
                        if(isset($_GET['id']))
                        {
                            $department_id = mysqli_real_escape_string($conn, $_GET['id']);
                            $query = "SELECT * FROM tbl_department WHERE id='$department_id' ";
                            $query_run = mysqli_query($conn, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $department = mysqli_fetch_array($query_run);
                            }
                        }
                        ?>  
                    <form action="controller.php" method="POST" class="p-3" id="department_master_form">
                        <?php if (isset($_GET['id'])) { ?>
                            <input type="text" class="form-control visually-hidden" id="id" name="id" value="<?php echo isset($department['id'])?$department['id']:''; ?>">
                        <?php }?>
                        <div class="mb-3">
                            <label for="deptname" class="form-label">Department</label>
                            <input type="text" class="form-control" id="deptname" name="deptname" value="<?php echo isset($department['deptname'])?$department['deptname']:''; ?>" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="deptslug" class="form-label">Slug</label>
                            <input type="text" class="form-control" id="deptslug" name="deptslug" value="<?php echo isset($department['deptslug'])?$department['deptslug']:''; ?>" required readonly>
                        </div>
                        <button type="submit" name="<?php echo isset($department['id'])?'update_department':'save_department'; ?>" class="btn btn-primary">Save</button>
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
