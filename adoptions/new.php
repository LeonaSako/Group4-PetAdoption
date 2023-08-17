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
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>

<body>
    <?php include '../components/navbar.php'; ?>    

    <!-- Add layout -->
    <?php
    foreach ($users as $user) {
        $imageSrc = "images/{$users["image"]}";    
        $firstName = $users["firstName"];
        $lastName = $users["lastName"];  
    }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-4">
            <div class="card" style="width: 18rem;">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                <h3 class='card-title'><?php  echo ($firstName); ?></h3>
                <br>
                    <p class="card-text"><?php  echo ($lastName); ?></p>
                </div>
                </div>
            </div>
            <div class="col-2"></div>
            <?php
                foreach ($pets as $pet) {
                    $imageSrc = "images/{$pets["image"]}";    
                    $name = $pets["name"];
                    $location = $pets["location"];
                    $age = $pets["age"]; 
                }
            ?>
            <div class="col-4">
                <div class="card" style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                    <h3 class='card-title'>Name:<?php  echo ($name); ?></h3>
                    <br>
                        <p class="card-text">Location:<?php  echo ($location); ?></p>
                        <br>
                        <p class="card-text">Age:<?php  echo ($age); ?> years old</p>
                    </div>
                </div>
            </div>
            </div>
            <div class="col-1"></div>
        </div>
    </div>

</body>

</html>