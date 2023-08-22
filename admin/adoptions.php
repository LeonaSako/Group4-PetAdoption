<?php
session_start();

require_once "../utils/crudAdoption.php";
require_once "../utils/crudUser.php";
require_once "../utils/crudPet.php";
require_once "../adoptions/viewAll.php";
require_once "../utils/formUtils.php";

$pageTitle = "Adoptions";

preventUser();
preventAgency();

$crud = new CRUD_ADOPTION();

$apply = $crud->selectAdoptions("adopStatus = 'Apply'");
$approved = $crud->selectAdoptions("adopStatus = 'Approved'");
$declined = $crud->selectAdoptions("adopStatus = 'Declined'");

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

</body>

</html>