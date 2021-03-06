<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SB Admin - Start Bootstrap Template</title>
    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway|Roboto" rel="stylesheet">
</head>

<body>
<?php
session_start();
?>

<div class="container">
    <div class="mx-auto mt-5">
        <div class="resgister_title">Time to feel like home,</div>
        <div class="card-body">
            <form action="" method="post">
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="exampleInputName">First name</label>
                            <input class="form-control" id="InputName" type="text" name="firstname"
                                   aria-describedby="nameHelp" placeholder="Enter first name">
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputLastName">Last name</label>
                            <input class="form-control" id="InputLastName" type="text" name="lastname"
                                   aria-describedby="nameHelp" placeholder="Enter last name">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <label for="exampleInputEmail1">Email address</label>
                        <input class="form-control" id="InputEmail" type="email" name="email"
                               aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="exampleInputPassword1">Password</label>
                                <input class="form-control" id="InputPassword" type="password" name="password"
                                       placeholder="Password">
                            </div>
                            <div class="col-md-6">
                                <label for="exampleConfirmPassword">Confirm password</label>
                                <input class="form-control" id="ConfirmPassword" type="password" name="password_confirm"
                                       placeholder="Confirm password">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="rookie"> Rookie?</label>
                        </div>
                    </div>
                    <input class="btn btn-primary btn-block" type="submit" name="register_submit" value="Register"/>
            </form>

            <?php include 'parts/registerscript.php'?>
            <div class="text-center">
                <!--<a class="d-block small mt-3" href="login.php">Login Page</a>-->
                <!--<a class="d-block small" href="forgot-password.php">Forgot Password?</a> -->
                <a class="d-block small mt-3" href="login.php">Already one of us? SIGN IN</a>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
