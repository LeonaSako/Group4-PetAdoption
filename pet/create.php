<?php
session_start();

require_once "../utils/crud.php";
require_once "../utils/file_upload.php";
require_once "../utils/formUtils.php";

preventUser();

# This checks who is creating the pet (Admin or Agency) and sets the value of the user's ID 

if (isset($_SESSION["Adm"])) {
    $userID = $_SESSION["Adm"];
} else {
    $userID = $_SESSION["Agency"];
}

# This is a script that handles the creation of a new pet.
#
# Use the following crud commands:
#
# $crud = new CRUD();
#
# for image upload use: $image = fileUpload($_FILES["image"], 'pet');
#
# $values = [$name, $image[0], $location, $species, $breed, $age, $size, $desc, $vaccine, $exp, $space, $behavior, $userID];
#
# $create = $crud->createPet($values);



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <link rel="stylesheet" href="../style/main.css">
    <title>Create</title>
</head>

<body>
    <?php include '../components/navbar.php'; ?>
    <div class="container">
        <div class="row justify-content-center">
            <?= $layout ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>