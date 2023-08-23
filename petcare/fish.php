<?php
session_start();

require_once "../utils/crudPet.php";
require_once "../pet/viewAll.php";
require_once "../components/breadcrumb.php";

$pageTitle = "Fish pet care";

addBreadcrumb('Home', '../home.php');
addBreadcrumb('Pets', '../pet/listings.php');
addBreadcrumb('Pet care', '../petcare/care.php');
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
        <h1 class="text-center"></h1>
        <div class="row">
            <h1>Fish Care:</h1>
            <div class="col-8">
                <p>
                <ul>
                    <li>
                        Fishkeeping Basics: Dive into the world of fish care, including tank setup, water quality, and habitat considerations.
                    </li>
                    <br>
                    <li>
                        Feeding and Diet: Learn about appropriate fish diets, feeding techniques, and maintaining a balanced nutritional intake.
                    </li>
                    <br>
                    <li>
                        Aquarium Maintenance: Get guidance on cleaning and maintaining your aquarium, changing water, and monitoring equipment.
                    </li>
                    <br>
                    <li>
                        Fish Health: Explore common fish health issues, quarantine practices, and recognizing signs of illness.
                </ul>
                </li>
                </p>
            </div>
            <div class="col-4">
                <img src="../images/pets/fish.jpg">
            </div>
            <div class="gap-2 d-md-flex justify-content-left" id="pet-of-day-btn">
                <a href="care.php" class="btn btn-warning">Back</a>
            </div>
        </div>
    </div>
</body>

</html>