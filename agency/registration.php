<?php

require_once "../utils/crudUser.php";
require_once "../utils/formUtils.php";
require_once "../utils/file_upload.php";

$pageTitle = "Sign-up";

session_start();

if (isset($_SESSION["Adm"])) {
    header("Location: ../admin/dashboard.php");
} else if (isset($_SESSION["User"])) {
    header("Location: ../user/dashboard.php");
} else if (isset($_SESSION["Agency"])) {
    header("Location: ../agency/dashboard.php");
}

$crud = new CRUD_USER();
$error = false;

$agency = $address = $email = $phone = $password = "";
$agencyError = $emailError = $passError = $addressError = $phoneError = "";

if (isset($_POST["sign-up"])) {

    $agency = cleanInputs($_POST["agency"]);
    $address = cleanInputs($_POST["address"]);
    $picture = fileUpload($_FILES["picture"], 'agency');
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
    if (empty($phone)) {
        $error = true;
        $phoneError = "Please, enter your Phone Number";
    } elseif (strlen($phone) < 3) {
        $error = true;
        $phoneError = "Please give a valid phone number";
    } elseif (!preg_match("/^[0-9]+$/", $phone)) {
        $error = true;
        $phoneError = "Phone number most contain only numbers";
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
    <?php include '../components/head.php'; ?>
    <link rel="stylesheet" href="../css/main.css">
    <title><?= $pageTitle ?></title>
</head>

<body>
    <?php include '../components/navbar.php'; ?>
    <div class="container">
        <h1 class="text-center">Sign Up </h1>
        <form method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="mb-3 mt-3">
                <label for="agency" class="form-label">Agency </label>
                <input type="text" class="form-control" id="fname" name="agency" placeholder="Agency name" value="<?= $agency ?>">
                <span class="text-danger"><?= $agencyError ?></span>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address </label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="<?= $address ?>">
                <span class="text-danger"><?= $addressError ?></span>
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
                <label for="phone" class="form-label">Phone Number</label>
                <input type="number" class="form-control" id="phone" name="phone" placeholder="Phone Number" value="<?= $phone ?>">
                <span class="text-danger"><?= $phoneError ?></span>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                <span class="text-danger"><?= $passError ?></span>

            </div>
            <button name="sign-up" type="submit" class="btn btn-primary">Create account </button>

            <span>You have an account already? <a href="../user/login.php">Sign in here </a></span>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>