<?php
require_once "db_connect.php";
require_once "upload.php";

session_start();

// if (isset($_SESSION["adm"])) {
//     header("Location: dashboard.php");
// }

if (isset($_SESSION["user"])) {
    header("Location: home.php");
}

$backBtn = "home.php";

if (isset($_SESSION["adm"])) {
    $backBtn = "dashboard.php";
}
$error = false;

$fname = $lname = $email =$address  =$phone=$space=$experienced =$password= $date_of_birth = "";
$fnameError = $lnameError = $dateError= $addressError =$phoneError= $emailError = $passError = "";

function cleanInput($param)
{
    $data = trim($param);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);

    return $data;
}

if (isset($_POST["sign-up"])) {
    $fname = cleanInput($_POST["firstName"]);
    $lname = cleanInput($_POST["lastName"]);
    $email = cleanInput($_POST["email"]);
    $address = cleanInput($_POST["address"]);
    $phone = cleanInput($_POST["phone"]);
    $space = cleanInput($_POST["space"]);
    $experienced = cleanInput($_POST["experienced"]);
    $password = $_POST["password"];
    $date_of_birth = cleanInput($_POST["birthdate"]);
    $picture = upload($_FILES["image"]);

    if (empty($fname)) {
        $error = true;
        $fnameError = "Please, enter your first name";
    } elseif (strlen($fname) < 3) {
        $error = true;
        $fnameError = "Name must have at least 3 characters.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $fname)) {
        $error = true;
        $fnameError = "Name must contain only letters and spaces.";
    }

    if (empty($lname)) {
        $error = true;
        $lnameError = "Please, enter your last name";
    } elseif (strlen($lname) < 3) {
        $error = true;
        $lnameError = "Name must have at least 3 characters.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $lname)) {
        $error = true;
        $lnameError = "Name must contain only letters and spaces.";
    }

    if (empty($date_of_birth)) {
        $error = true;
        $dateError = "Date of birth can't be empty!";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter a valid email address";
    } else {
        $query = "SELECT email FROM users WHERE email = '$email'";
        $result = mysqli_query($connect, $query);
        if (mysqli_num_rows($result) != 0) {
            $error = true;
            $emailError = "Provided Email is already in use";
        }
    }
    if (empty($address)) {
        $error = true;
        $$addressError = "Please, enter your Address";
    } elseif (strlen($address) < 3) {
        $error = true;
        $addressError = "Address must have at least 3 characters.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $address)) {
        $error = true;
        $addressError = "Address must contain only letters and spaces.";
    }
    if (empty($phone)) {
        $error = true;
        $phoneError = "Please, enter your Phone Number";
    } elseif (strlen($phone) < 3) {
        $error = true;
        $phoneError = "Please give a valid phone number";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/",$phone)) {
        $error = true;
        $phoneError = "Phone number most contain only numbers";
    }
    if (empty($space)) {
        $error = true;
        $spaceError = "Please, enter your Space";
    } elseif (strlen($space) < 2) {
        $error = true;
        $spaceError = "Address must have at least 2 characters.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/",$space)) {
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
        $sql = "INSERT INTO `users`(`firstName`, `lastName`,`address`, `image`, `birthdate`, `phone`, `email`, `password`, `space`, `experienced`) VALUES ('$fname','$lname','$address','$image','$birthdate','$phone','$email','$password','$space','$experienced') ";

        if (mysqli_query($connect, $sql)) {
            echo   "<div class='alert alert-success'>
               <p>New account has been created, $picture[1]</p>
                </div>";
            header("refresh: 3; url=$backBtn");
        } else {
            echo   "<div class='alert alert-danger'>
                    <p>Something went wrong, please try again later ...</p>
                </div>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="login.php">Log in</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
      </ul>
      
    </div>
  </div>
</nav>
<div class="container">
            <h1 class="text-center">Sign Up </h1>
            <form method="post" autocomplete="off" enctype="multipart/form-data">
                <div class="mb-3 mt-3" >
                    <label for="firstName" class="form-label">First name </label>
                    <input type="text" class="form-control" id="fname" name="firstName" placeholder="First name" value="<?=$fname?>" >
                    <span class="text-danger"><?=$fnameError?></span>
                </div>
                <div class="mb-3">
                    <label for="lastName" class="form-label">Last name </label>
                    <input type="text" class="form-control" id="lname" name="lastName" placeholder="Last name"value="<?=$lname?>">
                    <span class="text-danger"><?=$lnameError?></span>
                </div>
                <div class="mb-3">
                    <label for="birthdate" class="form-label">Date of birth</label>
                    <input type="date" class= "form-control" id="date" name="birthdate" value="<?=$date_of_birth?>">
                    <span class="text-danger"><?=$dateError?></span>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Profile picture </label>
                    <input type="file" class="form-control" id="picture" name="image">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address </label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email address" value="<?=$email?>">
                    <span class="text-danger"><?=$emailError?></span>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Address" value="<?=$address?>">
                    <span class="text-danger"><?=$addressError?></span>
                </div>
             
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <span class="text-danger"><?=$passError?></span>
                    
                </div>
                <button name="sign-up" type="submit" class="btn btn-primary" >Create account </button>
             
                <span>You have an account already? <a href="login.php">Sign in here </a></span>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>