<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Examcell</title>
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

<div class="container d-flex justify-content-center align-items-center" style="min-height:100vh;">
    <form action="authenticate.php" method="POST" class="border shadow p-3 rounded" style="width:450px;">
            <div class="text-center">
                <img src="../assets/images/avatar.png" alt="">
            </div>
            <h1 class="text-center p-3">RESET PASSWORD</h1>
            <div id="email_input">
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" required autofocus>
                </div>
            </div>
            <div id="pass_code_input">
                <div class="mb-3">
                    <label for="pass_code" class="form-label">Pass Code</label>
                    <input type="text" class="form-control" id="pass_code" name="pass_code" required>
                </div>
                <div class="mb-3">
                    <label for="new_password" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                </div>
            </div>
            <div class="text-center">
                <button type="button" id="password_reset" name="password_reset" class="btn btn-primary">Get Verification Code</button>
            </div>
            <div class="text-center">
                <a href="index.php">(Login Here)</a>
            </div>
        </form>
</div>
<script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src='../assets/jquery.min.js'></script>
<script src='../assets/jquery_validation/dist/jquery.validate.js'></script>
    <script>
        $(function() {
            // Email pattern to cross check correct email entered or not
            var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i
            $("#pass_code_input").addClass('visually-hidden');

            $("button[name=password_reset]").on('click', function() {

                if (($("input[name=email]").val() != '') && ($("input[name=pass_code]").val() == '') && ($("input[name=new_password]").val() == '')) {
                    if (testEmail.test($("input[name=email]").val())) {
                        var email = $("input[name=email]").val();
                        $.ajax({
                            type: "POST",
                            url: "controller.php",
                            data: {
                                "check_email_exists": true,
                                "email": email
                            },
                            cache:false,
                            success: function (data) {
                                data = JSON.parse(data);
                                if (data.success) {
                                    $("#email_input").addClass('visually-hidden');
                                    $("#pass_code_input").removeClass('visually-hidden');
                                    $("button[name=password_reset]").text('Reset');
                                } else {
                                    alert("Staff Not Found");
                                }
                            },
                            error: function(){
                                alert("Staff Not Found");
                            }
                        });
                    } else {
                        alert("Enter valid email");
                    }
                } else {
                    if (($("input[name=pass_code]").val() != '') && ($("input[name=new_password]").val() != '')) {
                        if ($("input[name=new_password]").val().length >= 8) {
                            var email = $("input[name=email]").val();
                            var pass_code = $("input[name=pass_code]").val();
                            var new_password = $("input[name=new_password]").val();

                            $.ajax({
                                type: "POST",
                                url: "controller.php",
                                data: {
                                    "change_staff_password": true,
                                    "email": email,
                                    "pass_code": pass_code,
                                    "new_password": new_password
                                },
                                cache:false,
                                success: function (data) {
                                    data = JSON.parse(data);
                                    if (data.success) {
                                        window.location.href = "index.php";
                                    } else {
                                        alert("Password change failed. Retry");
                                    }
                                },
                                error: function(){
                                    alert("Staff Not Found");
                                }
                            });       
                        } else {
                            alert("Password must be 8 characters long");
                        }
                    }
                }
            });

        });
    </script>
</body>

</html>