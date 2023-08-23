<?php
session_start();

require_once "../utils/crudPet.php";
require_once "../pet/viewAll.php";
require_once "../components/breadcrumb.php";

$pageTitle = "Dog training";

addBreadcrumb('Home', '../home.php');
addBreadcrumb('Pets', '../pet/listings.php');
addBreadcrumb('Pet training', '../petcare/care.php');
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
            <h1>Training & Tipps</h1>
            <div class="col-8">
                <p>
                <ul>
                    <li>
                        Be Consistent: Use the same commands and gestures consistently. Dogs learn through repetition and consistency, so avoid confusing them with different cues. <br>
                    </li>
                    <br>
                    <li>
                        Short Training Sessions: Keep training sessions short and focused, around 5-10 minutes, to prevent your dog from getting bored or overwhelmed.
                    </li>
                    <br>
                    <li>
                        Patience is Key: Dogs vary in how quickly they learn, so be patient and avoid getting frustrated. Stay calm and positive during training sessions.
                    </li>
                    <br>
                    <li>
                        Use High-Value Treats: Use treats that your dog finds extremely enticing for training sessions. These treats can motivate your dog to work harder and focus better.
                    </li>
                    </p>
            </div>
            <div class="col-4">
                <img src="../images/pets/dog.jpg">
            </div>
            <div class="gap-2 d-md-flex justify-content-left" id="pet-of-day-btn">
                <a href="care.php" class="btn btn-warning">Back</a>
            </div>
        </div>
    </div>
</body>

</html>