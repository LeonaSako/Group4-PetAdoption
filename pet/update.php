<?php
require_once "../utils/crud.php";
require_once "../utils/file_upload.php";
require_once "../utils/formUtils.php";

session_start();
preventUser();

$id = $_GET["id"];

# This is a script that handles the update of a pet's details.
#
# Use the following crud commands:
#
# $crud = new CRUD();
#
# $result = $crud->selectPets("id = $id"); 
#
# for image upload use: $image = fileUpload($_FILES["image"], 'pet');
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
# $update = $crud->updatePet($id, $name, $location, $species, $breed, $age, $size, $desc, $status, $vaccinated, $exp, $space, $behavior, $pic)


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <link rel="stylesheet" href="../style/main.css">
    <title>Update</title>
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