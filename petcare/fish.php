<?php
session_start();

require_once "../utils/crudPet.php";
require_once "../pet/viewAll.php";
require_once "../components/breadcrumb.php";

$pageTitle = "Fish pet care";

addBreadcrumb('Home', '../user/dashboard.php');
addBreadcrumb('Pets', '../pet/listings.php');
addBreadcrumb('Pet care', '../static/static.php');
addBreadcrumb('Fish');

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
        <h1 class="text-center">Fish Care</h1>
        <div class="row">
            <div class="col">
                <ul>
                    <li> Fishkeeping Basics: Dive into the world of fish care, including tank setup, water quality, and habitat considerations.</li>
                    <li> Feeding and Diet: Learn about appropriate fish diets, feeding techniques, and maintaining a balanced nutritional intake.</li>
                    <li> Aquarium Maintenance: Get guidance on cleaning and maintaining your aquarium, changing water, and monitoring equipment.</li>
                    <li> Fish Health: Explore common fish health issues, quarantine practices, and recognizing signs of illness.</li>
                </ul>
                
            
        </div>
        <div class="col">
                <img src="../images/pets/fish.jpg">
            </div>
        </div>
        <a class="btn" href="static.php">Back</a>
    </div>
</body>

</html>