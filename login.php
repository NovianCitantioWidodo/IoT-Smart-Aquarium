<?php 
session_start();
if (isset($_SESSION["password"])) {
    header("location:index.php");
}
 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport"/>
        <!-- Favicon -->
        <link href="assets/img/leaf.png" rel="icon" type="image/png"/>
        <link href="assets/css/argon-dashboard.css" rel="stylesheet"/>
        <link href="./assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet"/>
        <title>Login</title>
    </head>
    <body class="bg-gambar">
        <div class="main-content">
            <div class="d-flex justify-content-center">
                <div class="card m-4 border-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-center wow fadeInUp">
                                <h1>Real-Mi Auth</h1>
                                <p class="text-danger"><?php echo $_COOKIE["message"]; ?></p>
                                <form role="form" action="proseslogin.php" method="post">
                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="ni ni-email-83"></i>
                                                </span>
                                            </div>
                                            <input class="form-control" placeholder="Username" type="text" name="username" autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="ni ni-lock-circle-open"></i>
                                                </span>
                                            </div>
                                            <input class="form-control" placeholder="Password" type="number" name="password">
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary my-4">Masuk</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>