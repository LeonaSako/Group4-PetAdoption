<?php
session_start();

if (isset($_SESSION["Adm"])) {
    header("Location: ../admin/dashboard.php");
} else if (isset($_SESSION["User"])) {
    header("Location: ../user/dashboard.php");
} else if (isset($_SESSION["Agency"])) {
    header("Location: ../agency/dashboard.php");
}

require_once "../utils/crudUser.php";
require_once "../utils/formUtils.php";

$email = "";
$emailError = $passError = "";

$error = false;

if (isset($_POST["login"])) {

    $email = cleanInputs($_POST["email"]);
    $password = cleanInputs($_POST["password"]);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter a valid email address";
    }
    if (empty($password)) {
        $error = true;
        $passError = "Password can't be empty!";
    }

    if (!$error) {

        $password = hash("sha256", $password);

        $crud = new CRUD_USER();

        $condition = "email = '$email' AND password = '$password'";

        $result = $crud->selectUsers($condition);

        if (!empty($result)) {

            $user = $result[0];

            $_SESSION["UserEmail"] = $user["email"];

            if ($user["role"] == "Adm") {
                $_SESSION["Adm"] = $user["id"];
                header("Location: ../admin/dashboard.php");
            } else if ($user["role"] == "User") {
                $_SESSION["User"] = $user["id"];
                header("Location: ../user/dashboard.php");
            } else if ($user["role"] == "Agency") {
                $_SESSION["Agency"] = $user["id"];
                header("Location: ../agency/dashboard.php");
            }
        } else {
            echo "<div class='alert alert-danger'>
                        <p>The email or password provided do not match or they do not exist in our database.</p>
                    </div>";
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/main.css">
    <title>Login</title>
</head>

<body>
    <?php include '../components/navbar.php'; ?>
    <div class="container">
        <h1 class="text-center">Login page </h1>
        <div class="row">
            <div class="col-4">
                <br> <br>
                <form method="post">
                    <div class="mb-3">
                        <br>
                        <label for="email" class="form-label">Email address </label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email address" value="<?= $email ?>">
                        <span class="text-danger"><?= $emailError ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        <span class="text-danger"><?= $passError ?></span>
                    </div>
                    <button name="login" type="submit" class="btn btn-primary">Login</button><br><br>
                    <i class="fa fa-hand-o-down" style="font-size:24px"></i><br>
                    <span> <a href="registration.php">Register here </a> If you don't have an account, click here!</span>
                </form>
            </div>
            <div class="col-4">
                <br><br>
                <img src="../images/login/login.jpg" class="lo-img">
            </div>
            <div class="col-4"></div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>