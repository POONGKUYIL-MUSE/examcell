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
                            <h4><?php echo isset($_GET['id'])?'Edit':'Add'; ?> Batch</h4>
                    </div>
                    <div class="col-md-4">
                        <a href="batch.php" class="btn btn-success rounded float-end">Back</a>
                    </div>
                </div>
                <hr>
                <?php include '../helpers/message.php'; ?>
                <div>
                <?php
                        if(isset($_GET['id']))
                        {
                            $batch_id = mysqli_real_escape_string($conn, $_GET['id']);
                            $query = "SELECT * FROM tbl_batch WHERE id='$batch_id' ";
                            $query_run = mysqli_query($conn, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $batch = mysqli_fetch_array($query_run);
                            }
                        }
                        ?>  
                    <form action="controller.php" method="POST" class="p-3" id="batch_master_form">
                        <?php if (isset($_GET['id'])) { ?>
                            <input type="text" class="form-control visually-hidden" id="id" name="id" value="<?php echo isset($batch['id'])?$batch['id']:''; ?>">
                        <?php }?>
                        <div class="mb-3">
                            <label for="dept" class="form-label">Department</label>
                            <select class="form-select" name="dept" id="dept" aria-label="Default select example" autofocus required>
                                <option selected>Select Department</option>
                                <?php 
                                    $query = "SELECT * FROM tbl_department";
                                    $query_run = mysqli_query($conn, $query);
        
                                    if(mysqli_num_rows($query_run) > 0)
                                    {

                                        foreach ($query_run as $department) {
                                            $selected = '';
                                            if ($department['id'] == $batch['dept']) {
                                                $selected = 'selected';
                                            }
                                            echo "<option value='".$department['id']."' ".$selected.">".$department['deptname']."</option>";
                                        }
                                    }

                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="batchyear" class="form-label">Batch</label>
                            <input type="text" class="form-control" id="batchyear" name="batchyear" value="<?php echo isset($batch['batchyear'])?$batch['batchyear']:''; ?>" required>
                        </div>
                        <button type="submit" name="<?php echo isset($batch['id'])?'update_batch':'save_batch'; ?>" class="btn btn-primary">Save</button>
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
