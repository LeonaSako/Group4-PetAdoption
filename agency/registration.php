<?php

require_once "../utils/crud.php";
require_once "../utils/formUtils.php";
require_once "../utils/file_upload.php";

session_start();

if (isset($_SESSION["Adm"])) {
    header("Location: ../admin/dashboard.php");
} else if (isset($_SESSION["User"])) {
    header("Location: ../user/dashboard.php");
} else if (isset($_SESSION["Agency"])) {
    header("Location: ../agency/dashboard.php");
}

$crud = new CRUD();
$error = false;

$agency=$address =$email=$phone=$password= "";
$agencyError=$emailError = $passError = "";

if (isset($_POST["sign-up"])) {

    $agency = cleanInputs($_POST["agency"]);
    $address = cleanInputs($_POST["address"]);
    $email = cleanInputs($_POST["email"]);
    $phone = cleanInputs($_POST["phone"]);
    $password = $_POST["password"];

    if (empty($agency)) {
        $error = true;
        $agencyError = "Agency name ";
    } elseif (strlen($agency) < 3) {
        $error = true;
        $agencyError = "Name must have at least 3 characters.";
    } elseif (!validateName($agency)) {
        $error = true;
        $agencyError = "Name must contain only letters and spaces.";
    }
    if (empty($address)) {
        $error = true;
        $addressError = "Agency name ";
    } elseif (strlen($address) < 3) {
        $error = true;
        $addressError = "Name must have at least 3 characters.";
    } elseif (!validateName($address)) {
        $error = true;
        $addressError = "Name must contain only letters and spaces.";
    }
    if (empty($email)) {
        $error = true;
        $emailError = "Agency name ";
    } elseif (strlen($email) < 3) {
        $error = true;
        $emailError = "Name must have at least 3 characters.";
    } elseif (!validateName($email)) {
        $error = true;
        $addressError = "Name must contain only letters and spaces.";
    }
    if (empty($email)) {
        $error = true;
        $emailError = "Agency name ";
    } elseif (strlen($email) < 3) {
        $error = true;
        $emailError = "Name must have at least 3 characters.";
    } elseif (!validateName($email)) {
        $error = true;
        $addressError = "Name must contain only letters and spaces.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter a valid email address";
    } else {
        $result = $crud->selectUsers("email='$email'");
        if (!empty($result)) {
            $error = true;
            $emailError = "Provided Email is already in use";
        }
    }

    if (empty($password)) {
        $error = true;
        $passError = "Password can't be empty!";
    } elseif (strlen($password) < 6) {
        $error = true;
        $passError = "Password must have at least 6 characters.";
    }

    if (!$error) {
        $password = hash("sha256", $password);

        // `role`, `agency`, `address`, `email`, `phone`, `password`
        $values = ['Agency', $agency, $address, $email, $phone, $password];

        $crud->createAgency($values);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/main.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <h1 class="text-center">Sign Up </h1>
        <form method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="mb-3 mt-3">
                <label for="agency" class="form-label">Agency </label>
                <input type="text" class="form-control" id="fname" name="agency" placeholder="Agency name" value="<?= $agency ?>">
                <span class="text-danger"><?= $agencyError ?></span>
            </div>
            <div class="mb-3">
                <label for="lname" class="form-label">Last name </label>
                <input type="text" class="form-control" id="lname" name="lname" placeholder="Last name" value="<?= $lname ?>">
                <span class="text-danger"><?= $lnameError ?></span>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Date of birth</label>
                <input type="date" class="form-control" id="date" name="date_of_birth" value="<?= $date_of_birth ?>">
                <span class="text-danger"><?= $dateError ?></span>
            </div>
            <div class="mb-3">
                <label for="picture" class="form-label">Profile picture </label>
                <input type="file" class="form-control" id="picture" name="picture">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address </label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email address" value="<?= $email ?>">
                <span class="text-danger"><?= $emailError ?></span>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                <span class="text-danger"><?= $passError ?></span>

            </div>
            <button name="sign-up" type="submit" class="btn btn-primary">Create account </button>

            <span>You have an account already? <a href="login.php">Sign in here </a></span>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>