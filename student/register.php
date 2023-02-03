<?php 
require_once('../database/config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Examcell</title>
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel='stylesheet' href='../assets/jquery_validation/demo/site-demos.css'>
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center" style="min-height:100vh;">
        <form id="student_register_form" action="authenticate.php" method="POST" class="border shadow p-3 rounded" style="width:750px;">
            <div class="text-center">
                <img src="../assets/images/avatar.png" alt="">
            </div>
            <h1 class="text-center p-3">STUDENT REGISTRATION</h1>
            <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php $_GET['error']; ?>
                </div>
            <?php } ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="regno" class="form-label">Register Number</label>
                        <input type="text" class="form-control" id="regno" name="regno" value="<?php echo isset($student['regno']) ? $student['regno'] : ''; ?>" required autofocus>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="firstname" class="form-label">Firstname</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo isset($student['firstname']) ? $student['firstname'] : ''; ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="lastname" class="form-label">Lastname</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo isset($student['lastname']) ? $student['lastname'] : ''; ?>" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="student_department" class="form-label">Department</label>
                        <select class="form-select" name="student_department" id="student_department" aria-label="Default select example" requried>
                            <option selected>Select Department</option>
                            <?php
                            $query = "SELECT * FROM tbl_department";
                            $query_run = mysqli_query($conn, $query);
        
                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $department) {
                                    echo "<option value='" . $department['id'] . "' data-deptslug='" . $department['deptslug'] . "'>" . $department['deptname'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="student_batch" class="form-label">Batch</label>
                        <select class="form-select" name="student_batch" id="student_batch" aria-label="Default select example" required>
                            <option selected>Select Batch</option>
                            <?php
                            if (isset($_GET['id'])) {
                                $dept = $student['student_department'];
                                $query = "SELECT * FROM tbl_batch WHERE dept='$dept'";
                                $query_run = mysqli_query($conn, $query);
        
                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $batch) {
                                        echo "<option value='" . $batch['id'] . "'>" . $batch['batchyear'] . "</option>";
                                    }
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="phonenumber" class="form-label">Phone Number</label>
                        <input type="phonenumber" class="form-control" id="phonenumber" name="phonenumber" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <button type="submit" name="student_register" class="btn btn-primary">Register</button>
            </div>
            <hr>
            <div class="text-center">
                <a href="index.php">(Login Here)</a>
            </div>
        </form>
    </div>

    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src='../assets/jquery.min.js'></script>
    <link rel='stylesheet' type='text/css' href='../assets/datetimepicker/jquery.datetimepicker.css'/ >
    <script src='../assets/datetimepicker/build/jquery.datetimepicker.full.min.js'></script>
    <script src='../assets/jquery_validation/dist/jquery.validate.js'></script>
    <!-- <script src='../assets/scripts.js'></script> -->
    <script>
        $(function() {
            $("#student_register_form").validate({
                rules: {
                    regno: {required:true},
                    email: {required:true, email:true},
                    firstname: {required: true},
                    lastname: {required: true},
                    student_department: {required: true},
                    student_batch: {required: true},
                    phonenumber: {required: true, minlength:10, maxlength:10, digits:true}
                }
            });
            $("body").on('change', 'select[name=student_department]', function () {
            var deptid = $('select[name=student_department]').val();
            console.log(deptid);

            $('select[name=student_batch] option:not(:first)').remove();

            $.ajax({
                type: 'POST',
                url: 'controller.php',
                data: {
                    "get_department_batches": true,
                    "deptid": deptid
                },
                success: function (data) {
                    data = JSON.parse(data);
                    console.log(data);
                    if (data.success) {
                        var batches = data.batches;
                        var options = ``;
                        console.log(batches);
                        for (i = 0; i < batches.length; i++) {
                            options += `<option value='` + batches[i]['batchid'] + `'>` + batches[i]['batchyear'] + `</option>`;
                        }
                        $('select[name=student_batch]').append(options);
                    } else {
                        console.log("wrong");
                    }
                },
                error: function () {
                    console.log("Error");
                }
            });

            });
        });
    </script>
</body>

</html>