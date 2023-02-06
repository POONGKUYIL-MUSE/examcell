
<?php
if (isset($_SESSION['message'])) :
    $toast_class = 'show';
else :
    $toast_class = 'hide';
?>
    <div class="toast-container position-absolute p-3 mx-2 my-4 top-0 end-0" id="message_toast">
        <div class="toast align-items-center <?php echo $toast_class; ?>" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    Alert
                </div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <!-- <div class="alert alert-warning alert-dismissible fade show float-end mx-3 my-3" style="max-width:300px;" role="alert">
        <strong>Hey!</strong> <?= $_SESSION['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div> -->

<?php
    unset($_SESSION['message']);
endif;
?>