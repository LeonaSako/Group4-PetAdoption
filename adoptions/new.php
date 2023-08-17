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
 $crud = new CRUD();
#
$result1 = $crud->selectPets("id = $petID");
$result2 = $crud->selectUsers("id = $userID");
#
$pets = $result1[0];
$users = $result2[0];
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>

<body>
    <?php include '../components/navbar.php'; ?>    

    <!-- Add layout -->

</body>

</html>