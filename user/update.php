<?php

require_once "../utils/crudUser.php";
require_once "../utils/file_upload.php";
require_once "../utils/formUtils.php";

session_start();
preventUser();
preventAgency();

$id = $_GET["id"];
$crud = new CRUD_USER();

$result = $crud->selectUsers("id = $id");
$user = $result[0];
$fnameError = $lnameError = $dateError = $addressError = $phoneError = $emailError = $passError = $spaceError = "";

if (isset($_POST["update"])) {
    $firstname = cleanInputs($_POST["firstname"]);
    $lastname = cleanInputs($_POST["lastname"]);
    $email = cleanInputs($_POST["email"]);
    $address = cleanInputs($_POST["address"]);
    $phone = cleanInputs($_POST["phone"]);
    $space = cleanInputs($_POST["space"]);
    $exp = cleanInputs($_POST["experienced"]);
    $birthdate = cleanInputs($_POST["birthdate"]);
    $picture = fileUpload($_FILES["picture"], 'user');

    if (empty($firstname)) {
        $error = true;
        $fnameError = "Please, enter your first name";
    } elseif (strlen($firstname) < 3) {
        $error = true;
        $fnameError = "Name must have at least 3 characters.";
    } elseif (!validateName($firstname)) {
        $error = true;
        $fnameError = "Name must contain only letters and spaces.";
    }

    if (empty($lastname)) {
        $error = true;
        $lnameError = "Please, enter your last name";
    } elseif (strlen($lastname) < 3) {
        $error = true;
        $lnameError = "Name must have at least 3 characters.";
    } elseif (!validateName($lastname)) {
        $error = true;
        $lnameError = "Last name must contain only letters and spaces.";
    }

    if (empty($birthdate)) {
        $error = true;
        $dateError = "Date of birth can't be empty!";
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
    if (empty($address)) {
        $error = true;
        $$addressError = "Please enter your Address";
    } elseif (strlen($address) < 3) {
        $error = true;
        $addressError = "Address must have at least 3 characters.";
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
    if (empty($space)) {
        $error = true;
        $spaceError = "Please, enter your Space";
    } elseif (strlen($space) < 2) {
        $error = true;
        $spaceError = "Space must have at least 2 characters.";
    } elseif (!preg_match("/^[0-9]+$/", $space)) {
        $error = true;
        $spaceError = "Space";
    }

    if ($_FILES["picture"]["error"] == 0) {
        if ($result["image"] != "placeholder.jpg") {
            unlink("../images/users/$result[image]");
        }
        $update = $crud->updateUser($id, $firstname, $lastname, $address, $birthdate, $phone, $email, $space, $exp, $image[0]);
    } else {
        $image = null;
        $update = $crud->updateUser($id, $firstname, $lastname, $address, $birthdate, $phone, $email, $space, $exp, $image);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/main.css">
    <title>Document</title>
</head>

<body>
    <?php include '../components/navbar.php'; ?>

    <div class="container">
        <h1 class="text-center">Update user</h1>
        <form method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="row g-2">
                <div class="col-md-6">
                    <label for="firstname" class="form-label">First name </label>
                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First name" value="<?= $user['firstName'] ?>">
                    <span class="text-danger"><?= $fnameError ?></span>
                </div>
                <div class="col-md-6">
                    <label for="lastname" class="form-label">Last name </label>
                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last name" value="<?= $user['lastName']  ?>">
                    <span class="text-danger"><?= $lnameError ?></span>
                </div>
            </div>

            <div class="mb-3">
                <label for="date" class="form-label">Date of birth</label>
                <input type="date" class="form-control" id="date" name="birthdate" value="<?= $user['birthdate'] ?>">
                <span class="text-danger"><?= $dateError ?></span>
            </div>

            <div class="row g-2">
                <div class="col-md-8">
                    <label for="email" class="form-label">Email address </label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email address" value="<?= $user['email'] ?>">
                    <span class="text-danger"><?= $emailError ?></span>
                </div>
                <div class="col-md-4">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="number" class="form-control" id="phone" name="phone" placeholder="Phone Number" value="<?= $user['phone'] ?>">
                    <span class="text-danger"><?= $phoneError ?></span>
                </div>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="<?= $user['address'] ?>">
                <span class="text-danger"><?= $addressError ?></span>
            </div>
            <div class="mb-3">

            </div>
            <div class="mb-3">
                <label for="space" class="form-label">Space</label>
                <input type="number" class="form-control" id="space" name="space" placeholder="Space m3" value="<?= $user['space'] ?>">
                <span class="text-danger"><?= $spaceError ?></span>
            </div>
            <div class="mb-3">
                <label for="experienced" class="form-label">Do you have experience with the Pets?</label>
                <select name="experienced" id="experienced" class="form-control">
                    <option name="experienced" value="Yes">Yes</option>
                    <option name="experienced" value="No">No</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="picture" class="form-label">Profile picture </label>
                <input type="file" class="form-control" id="picture" name="picture">
            </div>


            <div class="buttons">
                <button name='update' type="submit" class="btn btn-primary">Update user</button>
                <a href="../admin/dashboard.php" class="btn btn-warning">Back to dashboard</a>
            </div>

        </form>

    </div>

</body>

</html>