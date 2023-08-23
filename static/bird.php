<?php
session_start();

require_once "../utils/crudPet.php";
require_once "../pet/viewAll.php";
require_once "../components/breadcrumb.php";

$pageTitle = "Bird pet care";

addBreadcrumb('Home', '../user/dashboard.php');
addBreadcrumb('Pets', '../pet/listings.php');
addBreadcrumb('Pet care', '../static/static.php');
addBreadcrumb('Bird');

?>

<!doctype html>
<html lang="en">

<head>
    <?php include '../components/head.php'; ?>
    <link rel="stylesheet" href="../css/main.css">
    <title><?= $pageTitle ?></title>
</head>

<body>
    <?php include '../components/navbar.php'; ?>
    <div class="container">
        <h1 class="text-center">Bird Care</h1>
        
            <div class="row">
                <div class="col">
                    <ul>
                        <li> Bird Care Fundamentals: Explore the essentials of providing a nurturing environment for pet birds, both large and small.</li>
                        <li>  Diet and Feeding: Learn about suitable bird diets, including seeds, pellets, fruits, and vegetables, to ensure optimal health.</li>
                        <li>Cage Setup and Enrichment: Find out how to create a comfortable cage with perches, toys, and mental stimulation.</li>
                        <li>  Grooming and Hygiene: Get tips on maintaining your bird's feathers, beak, and nails, and providing bathing opportunities.</li>
                    </ul>

                </div>
                <div class="col">
                   <img src="../images/pets/bird.jpg">
                </div>
            </div>
         <a class="btn" href="static.php">Back</a>  
            
    </div>

</body>

</html>