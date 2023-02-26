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
                            <h4><?php echo isset($_GET['id'])?'Edit':'Add'; ?> Email Service</h4>
                    </div>
                    <div class="col-md-4">
                        <a href="email_services.php" class="btn btn-success rounded float-end">Back</a>
                    </div>
                </div>
                <hr>
                <?php include '../helpers/message.php'; ?>
                <div>
                <?php
                        if(isset($_GET['id']))
                        {
                            $email_service_id = mysqli_real_escape_string($conn, $_GET['id']);
                            $query = "SELECT * FROM tbl_email_service WHERE id='$email_service_id' ";
                            $query_run = mysqli_query($conn, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $service = mysqli_fetch_array($query_run);
                                $email_service = [];
                                $email_service['id'] = $service['id'];
                                $email_service['email'] = $service['email'];
                                $properties = json_decode($service['properties']);
                                $email_service['email_username'] = $properties->email_username;
                                $email_service['email_host'] = $properties->email_host;
                                $email_service['email_secure'] = $properties->email_secure;
                                $email_service['email_port'] = $properties->email_port;
                            }
                        }
                        ?>  
                    <form action="controller.php" method="POST" class="p-3" id="email_service_form">
                        <?php if (isset($_GET['id'])) { ?>
                            <input type="text" class="form-control visually-hidden" id="id" name="id" value="<?php echo isset($email_service['id'])?$email_service['id']:''; ?>">
                        <?php }?>
                        <div class="row mb-1">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Valid Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($email_service['email'])?$email_service['email']:''; ?>" placeholder="Like ngpasc.examcell@gmail.com" required autofocus>
                            </div>
                            <div class="col-md-6">
                                <label for="email_username" class="form-label">Valid Email Username</label>
                                <input type="email" class="form-control" id="email_username" name="email_username" value="<?php echo isset($email_service['email_username'])?$email_service['email_username']:''; ?>" placeholder="autopopulated" readonly required>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-6">
                                <label for="email_host" class="form-label">Email Host</label>
                                <input type="text" class="form-control" id="email_host" name="email_host" value="<?php echo isset($email_service['email_host'])?$email_service['email_host']:''; ?>" placeholder="Like smtp.gmail.com" required>
                            </div>
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password<small> (App Specific Password)</small></label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="App Specific Password" <?php echo isset($email_service['id'])?'':'required'?>>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-6">
                                <label for="email_secure" class="form-label">Email Secure</label>
                                <input type="text" class="form-control" id="email_secure" name="email_secure" value="<?php echo isset($email_service['email_secure'])?$email_service['email_secure']:''; ?>" placeholder="Like ssl" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email_port" class="form-label">Email Port</label>
                                <input type="number" class="form-control" id="email_port" name="email_port" value="<?php echo isset($email_service['email_port'])?$email_service['email_port']:''; ?>" placeholder="Like 465,25" required>
                            </div>
                        </div>
                        <hr>
                        <button type="submit" name="<?php echo isset($email_service['id'])?'update_email_service':'save_email_service'; ?>" class="btn btn-primary">Save</button>
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
