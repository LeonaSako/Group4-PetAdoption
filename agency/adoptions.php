<?php
session_start();

require_once "../utils/crudAdoption.php";
require_once "../utils/crudUser.php";
require_once "../utils/crudPet.php";
require_once "../adoptions/viewAll.php";
require_once "../utils/formUtils.php";
require_once "../components/breadcrumb.php";

addBreadcrumb('Dashboard', '../agency/dashboard.php');
addBreadcrumb('Adoptions', '../agency/adoptions.php');
addBreadcrumb('All');

$pageTitle = "Adoption list";

preventUser();
preventAdmin();

$crud = new CRUD_ADOPTION();

$id = $_SESSION["Agency"];

$apply = $crud->selectAgencyAdoptions("pet.fk_users_id = $id AND adopStatus = 'Apply'");
$approved = $crud->selectAgencyAdoptions("pet.fk_users_id = $id AND adopStatus = 'Approved'");
$declined = $crud->selectAgencyAdoptions("pet.fk_users_id = $id AND adopStatus = 'Declined'");

$pending = viewAdoptions($apply);
$accepted = viewAdoptions($approved);
$rejected = viewAdoptions($declined);

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

        <?php include '../components/adoptionsAccordeon.php'; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>