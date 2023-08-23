<?php
session_start();

require_once "../utils/crudPet.php";
require_once "../pet/viewAll.php";
require_once "../components/breadcrumb.php";
$pageTitle = "Pet listings";

$crud = new CRUD_PET();

$result = $crud->selectPets("");
$layout = viewPets($result);

$POD = $crud->selectPets("pet_day = 1");
$petofday = viewPetDetails($POD);

addBreadcrumb('Home', '../home.php');
addBreadcrumb('Pets', '../pet/listings.php');
addBreadcrumb('');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../components/head.php'; ?>
    <link rel="stylesheet" href="../css/main.css">
    <title><?= $pageTitle ?></title>
</head>

<body>
    <?php include '../components/navbar.php'; ?>
    <div class="container" id='POD-container'>
        <h2 class="h2-header">Pet of the day</h2>
        <p class="d-inline-flex gap-1">
        <div class="gap-2 d-md-flex justify-content-center">
            <a id="collapseButton" class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                See pet of the day
            </a>
        </div>
        </p>
        <div class="collapse" id="collapseExample">
            <div class="row row-cols-lg-2 row-cols-md-1 row-cols-sm-1 row-cols-xs-1">
                <?= $petofday ?>
            </div>
        </div>
    </div>
    <main class="cd-main-content">
        <div class='container'>
            <section class="gallery">
                <div id="layout" class="grid"  >
                    <?= $layout ?>
                </div>
            </section>
            <div id="filter">
                <form class="filter-form">
                    <div class="filter-header">
                        <h4>Filters</h4>
                    </div>
                    <br>
                    <div class="filter-block ">
                        <h4>Adoption status</h4>
                        <ul class="filter-content filters list">
                            <li>
                                <input class="filter" data-filter="" type="radio" name="radioButton" id="radio1" checked>
                                <label class="radio-label" for="radio1">All</label>
                            </li>
                            <li>
                                <input class="filter" data-filter=".radio2" type="radio" name="radioButton" id="radio2">
                                <label class="radio-label" for="radio2">Available</label>
                            </li>
                            <li>
                                <input class="filter" data-filter=".radio3" type="radio" name="radioButton" id="radio3">
                                <label class="radio-label" for="radio3">Adopted</label>
                            </li>
                        </ul>
                    </div>
                    <div class="filter-block">
                        <h4>Search species</h4>
                        <div class="filter-content">
                            <input id="search-breed" type="search" placeholder="e.g. labrador">
                        </div>
                    </div>
                    <div class="filter-block">
                        <h4>Species</h4>
                        <ul class="filter-content filters list">
                            <li>
                                <input class="species-checkbox" data-filter="Cat" type="checkbox" id="check_cat">
                                <label class="checkbox-label" for="checkbox1">Cat</label>
                            </li>
                            <li>
                                <input class="species-checkbox" data-filter="Dog" type="checkbox" id="check_dog">
                                <label class="checkbox-label" for="checkbox2">Dog</label>
                            </li>
                            <li>
                                <input class="species-checkbox" data-filter="Fish" type="checkbox" id="check_fish">
                                <label class="checkbox-label" for="checkbox3">Fish</label>
                            </li>
                            <li>
                                <input class="species-checkbox" data-filter="Bird" type="checkbox" id="check_bird">
                                <label class="checkbox-label" for="checkbox3">Bird</label>
                            </li>
                        </ul>
                    </div>
                    <div class="filter-block">
                        <h4>Size</h4>
                        <ul class="filter-content filters list">
                            <li>
                                <input class="size-checkbox" data-filter="Small" type="checkbox">
                                <label class="checkbox-label" for="checkbox1">Small</label>
                            </li>
                            <li>
                                <input class="size-checkbox" data-filter="Medium" type="checkbox">
                                <label class="checkbox-label" for="checkbox2">Medium</label>
                            </li>
                            <li>
                                <input class="size-checkbox" data-filter="Large" type="checkbox">
                                <label class="checkbox-label" for="checkbox3">Large</label>
                            </li>
                        </ul>
                    </div>
                    <div class="filter-block">
                        <h4>Vaccination</h4>
                        <ul class="filter-content filters list">
                            <li>
                                <input class="vaccine-checkbox" data-filter="1" type="checkbox">
                                <label class="checkbox-label" for="checkbox1">Vaccinated</label>
                            </li>
                        </ul>
                    </div>
                    <div class="filter-block">
                        <div class="gap-2 d-md-flex justify-content-center">
                            <button id="reset-btn" type="button" class="btn btn-primary">Reset</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </main>

    <script src="../js/jquery-3.7.0.min.js"></script>
    <script type="text/javascript" src="../js/petofday.js"></script>
    <script type="text/javascript" src="../js/filter.js"></script>
    <script type="text/javascript" src="../js/searchPet.js"></script>

</body>

</html>