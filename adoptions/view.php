<?php

session_start();

require_once "../utils/crudAdoption.php";
require_once "../utils/crudPet.php";
require_once "../components/breadcrumb.php";
$pageTitle = "Adoptions";

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

    $url = "#";

    $btnattr = "hidden";

    if ($status == 'Apply') {
        $application = 'pending';
        $url = "cancel.php?id=" . $adoption["id"];
        $btnattr = "";
    } elseif ($status == 'Approved') {
        $application = 'approved';
    } else {
        $application = 'rejected';
    }

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
                    <p>Your application is <b>$application</b>.</p>
            HTML;
          
                if ($status == 'Apply') {
                $layout .= <<<HTML
                        <p class="card-text">No information available.</p>
                HTML;
                } elseif ($status == 'Approved') {
                    $layout .= <<<HTML
                            <p class="card-text"> Congratulations on choosing to adopt $name!</p>
                HTML;
                } elseif ($status == 'Declined') {
                    $layout .= <<<HTML
                            <p class="card-text"> Sorry, your application is declined.</p>
                HTML;
                }
                    
                $layout .= <<<HTML
               
               <a href="{$url}" class="btn btn-primary" $btnattr >Cancel</a>
                </div>

                <div class="card-footer text-body-secondary">
                Submitted $daysAgo $daytext ago
            </div>
        </div>
    HTML;
   
} else {
    $layout .= "No results";
}

addBreadcrumb('Home', '../user/dashboard.php');
addBreadcrumb('User', '../user/profile.php?id=' . $_SESSION["User"]);
addBreadcrumb('Adoptions', '../adoptions/myadoptions.php');
addBreadcrumb('Details');
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
    <div class="container">
        <?= $layout ?>
    </div>

</body>

</html>

