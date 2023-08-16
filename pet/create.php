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

# This is a script that handles the creation of a new pet. Only admins and agencies are allowed here.
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
    <title>Document</title>
</head>

<body>
    <?php include '../components/navbar.php'; ?>
    <!-- Add layout -->
</body>

</html>