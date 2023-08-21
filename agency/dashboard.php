<?php
session_start();

require_once "../utils/crudPet.php";
require_once "../pet/viewAll.php";
require_once "../utils/formUtils.php";
require_once "../components/breadcrumb.php";

addBreadcrumb('Dashboard', '../agency/dashboard.php');

$pageTitle = "Dashboard";

preventUser();
redirectAgencyToLogin();
preventAdmin();

$crud = new CRUD_PET();
$agencyId = $_SESSION["Agency"];

$result = $crud->selectPets("`fk_users_id` = $agencyId");

$layout = viewPets($result);

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>

</html>