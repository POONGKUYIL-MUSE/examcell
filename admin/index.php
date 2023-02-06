<?php
session_start();
include '../helpers/basic_helper.php';

echo site_header();

if (isset($_SESSION['email']) && isset($_SESSION['id'])) {
    header("Location: dashboard.php");
} else {
?>


<div class="container d-flex justify-content-center align-items-center" style="min-height:100vh;">
    <form action="authenticate.php" method="POST" class="border shadow p-3 rounded" style="width:450px;">
            <div class="text-center">
                <img src="../assets/images/avatar.png" alt="">
            </div>
            <h1 class="text-center p-3">STAFF LOGIN</h1>
            <?php /*if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= lang($_GET['error']) ?>
                </div>
            <?php }*/ ?>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required autofocus>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <!-- <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div> -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="text-center">
                <a href="forgot_pass.php">(Forgot Password)</a>
            </div>
        </form>
</div>

<?php } ?>
<?php echo site_footer(); ?>