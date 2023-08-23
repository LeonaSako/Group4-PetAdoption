<?php
session_start();

require_once "../utils/crudPet.php";
require_once "../utils/crudAdoption.php";
require_once "../utils/formUtils.php";
require_once "../pet/viewAll.php";
require_once "../components/breadcrumb.php";

addBreadcrumb('Home', '../user/dashboard.php');
addBreadcrumb('User', '../user/profile.php?id=' . $_SESSION["User"]);
addBreadcrumb('Adoptions', '../adoptions/myadoptions.php');
addBreadcrumb('Apply');

$pageTitle = "New adoption";

$petID = $_GET["id"];

$userID = $_SESSION["User"];

$crud = new CRUD_PET();

$crudAdoption = new CRUD_ADOPTION();

$result = $crud->selectPets("id = $petID");

$petDetails = viewPetDetails($result);

if (isset($_POST['adoption-submit'])) {

    $submitionDate = date('Y-m-d H:i:s');
    $adoptionDate = $_POST['adoptionDate'];
    $donation = $_POST['donation'];
    $reason = $_POST['reason'];

    $values = [$petID, $userID, $submitionDate, $donation, $reason, $adoptionDate];

    $crudAdoption->createAdoption($values);
}



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
        <form method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="card">
                <div class="card-header">
                    <h2>New adoption</h2>
                </div>
                <div class="card-body">
                    <div class='mb-3'>
                        <label for='adoptionDate' class='form-label'>Adoption Date</label>
                        <input type='date' name='adoptionDate' class='form-control' id='adoptionDate' required>
                    </div>
                    <label for="donation" class="form-label">Adoption donation (optional)</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">€</span>
                        <input type="number" class="form-control" placeholder="Give amount in euro" aria-label="Amount (to the nearest euro)">
                    </div>
                    <div class='mb-3'>
                        <label for='reason' class='form-label'>Adoption reason</label>
                        <textarea class="form-control" id='reason' name="reason" rows="4" cols="50" placeholder="Give an adoption reason"></textarea>
                    </div>
                    <div class="gap-2 d-md-flex justify-content-center">
                        <a href="../pet/listings.php" class="btn btn-warning">Go back</a>
                        <button type='submit' name='adoption-submit' class='btn btn-primary'>Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="container">
        <div class="row">
            <h2 class="h2-header">Pet details</h2>
            <?= $petDetails ?>
        </div>
    </div>
</body>

</html>