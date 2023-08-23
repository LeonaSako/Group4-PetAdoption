<?php
session_start();

require_once "../utils/crudPet.php";
require_once "../pet/viewAll.php";
require_once "../components/breadcrumb.php";

$pageTitle = "Cat pet care";

addBreadcrumb('Home', '../home.php');
addBreadcrumb('Pets', '../pet/listings.php');
addBreadcrumb('Pet care', '../petcare/care.php');
addBreadcrumb('Cat');

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
            <h1>Cat Care:</h1>
            <div class="col-8">
                <p>
                <ul>
                    <li>
                        Cat Care Essentials: Explore the unique aspects of caring for a feline friend and creating a comfortable home environment. </li>
                    <br>
                    <li>
                        Diet and Nutrition: Learn about the nutritional requirements of cats, including feeding guidelines and recommended food types. </li>
                    <br>
                    <li>
                        Enrichment and Play: Discover ways to stimulate your cat's mind and body through play, toys, and interactive activities.
                    </li>
                    <br>
                    <li>
                        Grooming and Hygiene: Find tips on grooming your cat, including brushing, nail trimming, and dental care.
                    </li>
                    </p>
                    
            </div>
            <div class="col-4">
                <img src="../images/pets/cat.jpg">
            </div>
            <div class="gap-2 d-md-flex justify-content-left" id="pet-of-day-btn">
                <a href="care.php" class="btn btn-warning">Back</a>
            </div>
        </div>
    </div>
</body>

</html>