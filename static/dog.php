<?php
session_start();

require_once "../utils/crudPet.php";
require_once "../pet/viewAll.php";
require_once "../components/breadcrumb.php";

$pageTitle = "Dog pet care";

addBreadcrumb('Home', '../user/dashboard.php');
addBreadcrumb('Pets', '../pet/listings.php');
addBreadcrumb('Pet care', '../static/static.php');
addBreadcrumb('Dog');

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
            <h1>Dog Care:</h1>
            <div class="col-1"></div>
            <div class="col-5">
                <p>
                <ul>
                    <li>
                        Introduction to Dog Care: Learn the basics of providing a loving and healthy environment for your canine companion.
                    <li>
                        <br>
                    <li>
                        Feeding and Nutrition: Understand the dietary needs of dogs, including portion control, suitable foods, and feeding schedules.
                    </li>
                    <br>
                    <li>
                        Exercise and Play: Discover the importance of physical activity for dogs, and get ideas for engaging exercises and games.
                    </li>
                    <br>
                    <li>
                        Grooming and Hygiene: Find out how to keep your dog's coat, nails, and teeth clean and well-maintained.
                    </li>
                    <br>
                    <li>
                        Health and Veterinary Care: Get insights into preventive care, vaccinations, common health issues, and regular vet visits.
                    </li>
                    </p>
                    <a href="static.php">Back</a>
            </div>
            <div class="col-4">
                <img src="../images/pets/dog.jpg">
            </div>
            <div class="col-2"></div>
        </div>
    </div>
</body>

</html>