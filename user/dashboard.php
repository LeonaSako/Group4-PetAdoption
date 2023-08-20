<?php
session_start();

require_once "../utils/crudPet.php";
require_once "../pet/viewAll.php";
require_once "../components/breadcrumb.php";
$pageTitle = "User dashboard";

$crud = new CRUD_PET();

$result = $crud->selectPets("");

$layout = viewPets($result);

addBreadcrumb('Home', '../user/dashboard.php');

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
        <div id="layout" class="row">
            <?= $layout ?>
        </div>
    </div>

</body>

</html>