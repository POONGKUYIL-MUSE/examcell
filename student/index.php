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
            <h1 class="text-center p-3">STUDENT LOGIN</h1>
            <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php $_GET['error']; ?>
                </div>
            <?php } ?>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Login</button>
                <a href="register.php" class="btn btn-primary">Register</a>
            </div>
        </form>
    </div>

    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>