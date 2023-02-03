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
                            <h4><?php echo isset($_GET['id'])?'Edit':'Add'; ?> Room</h4>
                    </div>
                    <div class="col-md-4">
                        <a href="room.php" class="btn btn-success rounded float-end">Back</a>
                    </div>
                </div>
                <hr>
                <?php include 'message.php'; ?>
                <div>
                <?php
                        if(isset($_GET['id']))
                        {
                            $room_id = mysqli_real_escape_string($conn, $_GET['id']);
                            $query = "SELECT * FROM tbl_room WHERE id='$room_id' ";
                            $query_run = mysqli_query($conn, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $room = mysqli_fetch_array($query_run);
                            }
                        }
                        ?>  
                    <form id="room_master_form" action="controller.php" method="POST" class="p-3 validate_rooms">
                        <?php if (isset($_GET['id'])) { ?>
                            <input type="text" class="form-control visually-hidden" id="id" name="id" value="<?php echo isset($room['id'])?$room['id']:''; ?>">
                        <?php }?>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="room" class="form-label">Room</label>
                                    <input type="text" class="form-control" id="room" name="room" value="<?php echo isset($room['room'])?$room['room']:''; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="dept" class="form-label">Department</label>
                                    <select class="form-select" name="dept" id="dept" aria-label="Default select example" autofocus>
                                        <option selected>Select Department</option>
                                        <?php 
                                            $query = "SELECT * FROM tbl_department";
                                            $query_run = mysqli_query($conn, $query);
                
                                            if(mysqli_num_rows($query_run) > 0)
                                            {
                                                foreach ($query_run as $department) {
                                                    $selected = '';
                                                    if (isset($_GET['id'])) {
                                                        if ($department['id'] == $room['dept']) {
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
                                    <label for="block" class="form-label">Block</label>
                                    <select class="form-select" name="block" id="block" aria-label="Default select example" autofocus>
                                        <option selected>Select Block</option>
                                        <?php 
                                            if (isset($_GET['id'])) {
                                                $dept = $room['dept'];
                                                $query = "SELECT * FROM tbl_block WHERE dept='$dept'";
                                                $query_run = mysqli_query($conn, $query);
                    
                                                if(mysqli_num_rows($query_run) > 0)
                                                {
                                                    foreach ($query_run as $block) {
                                                        $selected = '';
                                                        if (isset($_GET['id'])) {
                                                            if ($block['id'] == $room['block']) {
                                                                $selected = 'selected';
                                                            }
                                                        }
                                                        echo "<option value='".$block['id']."' ".$selected.">".$block['block']."</option>";
                                                    }
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="capacity" class="form-label">Capacity</label>
                                    <input type="text" class="form-control" id="capacity" name="capacity" value="<?php echo isset($room['capacity'])?$room['capacity']:''; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="row_dim" class="form-label">Rows</label>
                                    <input type="text" class="form-control" id="row_dim" name="row_dim" value="<?php echo isset($room['row_dim'])?$room['row_dim']:''; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="col_dim" class="form-label">Columns</label>
                                    <input type="text" class="form-control" id="col_dim" name="col_dim" value="<?php echo isset($room['col_dim'])?$room['col_dim']:''; ?>" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="<?php echo isset($room['id'])?'update_room':'save_room'; ?>" class="btn btn-primary validate_rooms">Save</button>
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
