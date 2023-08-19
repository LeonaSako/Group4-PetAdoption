<?php

session_start();

require_once "../utils/crudAdoption.php";
require_once "../utils/crudPet.php";
$id = $_GET["id"];

$crud = new CRUD_ADOPTION();

$result = $crud->selectAdoptions("id = $id");

$layout = "";

if (!empty($result)) {

    $adoption = $result[0];

    $petId = $adoption["fk_pet_id"];

    $crudpet = new CRUD_PET();

    $getPet = $crudpet->selectPets("id = $petId");

    $pet = $getPet[0];

    $name = $pet["name"];

    $status = $adoption["adopStatus"];

    $application = ($status == 'Apply') ? 'pending' : (($status == 'Approved') ? 'approved' : 'rejected');
    $submitted = $adoption["submitionDate"];
    $today = date("Y-m-d");
    $diff = strtotime($today) - strtotime($submitted);
    $daysAgo = floor($diff / (60 * 60 * 24));
    $daytext = ($daysAgo == 1) ? 'day' : 'days';

    $reason = $adoption["reason"];



    $layout .= <<<HTML
            <div class="card text-center">
                <div class="card-header">
                My adoption application
                </div>
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text">Congratulations on choosing to adopt $name ! </p>
                    <p>Your application is <b>$application</b>.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
                <div class="card-footer text-body-secondary">
                Submitted $daysAgo $daytext ago
                </div>
            </div>
   HTML;
} else {
    $layout .= "No results";
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/main.css">
    <title>Document</title>
</head>

<body>
    <?php include '../components/navbar.php'; ?>
    <div class="container">
        <?= $layout ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>