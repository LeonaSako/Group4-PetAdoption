<?php
session_start();

require_once "../utils/crud.php";
require_once "../utils/formUtils.php";

$petID = $_GET["id"];
$userID = $_SESSION["User"];

# This is a script that handles the creation of a new adoption. 
#
# Use the following crud commands:
#
# $crud = new CRUD();
#
# $result1 = $crud->selectPets("id = $petID");
# $result2 = $crud->selectUsers("id = $userID");
#
# $pet = $result1[0];
# $user = $result2[0];
# 
# $values = [$petID, $userID, $submitionDate, $donation, $reason];
#
# $adoption = $crud->makeAdoption($values);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <?php include '../components/navbar.php'; ?>

    <!-- Add layout -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</body>

</html>