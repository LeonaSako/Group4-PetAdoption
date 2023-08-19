<?php
session_start();

require_once "../utils/crudPet.php";
require_once "../pet/viewAll.php";

$crud = new CRUD_PET();

$result = $crud->selectPets("");

$layout = viewPets($result);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/main.css">
    <title>Title</title>
</head>

<body>
    <?php include '../components/navbar.php'; ?>
    <header class="header">
        <h2>Pet adoption listing</h2>
    </header>
    <main class="cd-main-content">

        <section class="gallery">
            <div id="layout">
                <ul>
                    <?= $layout ?>
                </ul>

            </div>
        </section>
        <div id="filter">
            <form class="filter-form">
                <div class="filter-header">
                    <h4>Filters</h4>
                </div>
                <br>
                <div class="filter-block">
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
            </form>

        </div>
    </main>

    <script src="../js/jquery-3.7.0.min.js"></script>
    <script type="text/javascript" src="../js/filter.js"></script>
    <script type="text/javascript" src="../js/searchPet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>

</html>