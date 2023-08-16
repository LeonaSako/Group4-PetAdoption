<?php
require_once "../utils/crud.php";
require_once "../utils/file_upload.php";
require_once "../utils/formUtils.php";

session_start();
preventUser();
preventAgency();

$id = $_GET["id"];

# This is a script that handles the update of a user's details. Only the admin is allowed here.
#
# Use the following crud commands:
#
# $crud = new CRUD();
#
# $result = $crud->selectUsers("id = $id"); 
#
# for image upload use: $image = fileUpload($_FILES["image"], 'user');
#   
# Check if a new image has been uploaded to set the value of the column `image`:
#
# if ($_FILES["image"]["error"] == 0) {
#   $pic = $image[0]; 
# } else {
#    $pic = null;
# }
#
# Then use the crud:
# 
# $update = $crud->updateUser($id, $fname, $lname, $address, $birthdate, $phone, $email, $space, $exp, $pic)


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