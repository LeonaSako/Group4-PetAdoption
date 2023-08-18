<?php
session_start();

require_once "../utils/crudAdoption.php";
require_once "../utils/crudUser.php";
require_once "../utils/crudPet.php";
require_once "../adoptions/viewAll.php";
require_once "../utils/formUtils.php";

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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/main.css">
    <title>Adoption List</title>

</head>

<body>
    <?php include '../components/navbar.php'; ?>
    <header class="header">
        <h2>Adoption applications</h2>
    </header>
    <div class="container">

        <?php include '../components/adoptionsAccordeon.php'; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>