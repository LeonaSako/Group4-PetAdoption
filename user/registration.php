<?php

require_once "../utils/crud.php";
require_once "../utils/formUtils.php";
require_once "../utils/file_upload.php";


$crud = new CRUD();
$error = false;

$firstname = $lastname = $email=$address=$phone=$space=$experienced=$password = $birthdate= "";
$fnameError = $lnameError = $dateError= $addressError=$phoneError = $emailError = $passError =$spaceError= "";

if (isset($_POST["sign-up"])) {
    $firstname = cleanInputs($_POST["firstname"]);
    $lastname = cleanInputs($_POST["lastname"]);
    $email = cleanInputs($_POST["email"]);
    $address = cleanInputs($_POST["address"]);
    $phone = cleanInputs($_POST["phone"]);
    $space = cleanInputs($_POST["space"]);
    $experienced = cleanInputs($_POST["experienced"]);
    $password = $_POST["password"];
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
        if ($result[1] > 0) {
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
    } elseif (!preg_match("/^[0-9]+$/",$phone)) {
        $error = true;
        $phoneError = "Phone number most contain only numbers";
    }
    if (empty($space)) {
        $error = true;
        $spaceError = "Please, enter your Space";
    } elseif (strlen($space) < 2) {
        $error = true;
        $spaceError = "Space must have at least 2 characters.";
    } elseif (!preg_match("/^[0-9]+$/",$space)) {
        $error = true;
        $spaceError = "Space";
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

        $values = ['User', $firstname, $lastname, $email , $phone, $address, $picture[0], $birthdate, $space, $experienced, $password];

        $crud->createUser($values);
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
                <label for="firstname" class="form-label">First name </label>
                <input type="text" class="form-control" id="fname" name="firstname" placeholder="First name" value="<?= $firstname ?>">
                <span class="text-danger"><?= $fnameError ?></span>
            </div>
            <div class="mb-3">
                <label for="lname" class="form-label">Last name </label>
                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last name" value="<?= $lastname ?>">
                <span class="text-danger"><?= $lnameError ?></span>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Date of birth</label>
                <input type="date" class="form-control" id="date" name="birthdate" value="<?= $birthdate ?>">
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
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="<?=$address?>">
                    <span class="text-danger"><?=$addressError?></span>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="number" class="form-control" id="phone" name="phone" placeholder="Phone Number" value="<?=$phone?>">
                    <span class="text-danger"><?=$phoneError?></span>
                </div>
                <div class="mb-3">
                    <label for="space" class="form-label">Space</label>
                    <input type="number" class="form-control" id="space" name="space" placeholder="Space m3" value="<?=$space?>">
                    <span class="text-danger"><?=$spaceError?></span>
                </div>
                <label for="experienced">Do you have experience with the Pets?</label>
                <select class="form-select" name="experienced" id="experienced">
               <option name="experienced" value="Yes">Yes</option>
               <option name="experienced" value="No">No</option>
             
            </select>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                <span class="text-danger"><?= $passError ?></span>
            </div>
            <button name="sign-up" type="submit" class="btn btn-primary">Create account </button>

            <span>You have an account already? <a href="login.php">Sign in here </a></span>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>