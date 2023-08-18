<?php
session_start();

require_once "../utils/crudAdoption.php";
require_once "../utils/crudUser.php";
require_once "../utils/crudPet.php";
require_once "../adoptions/viewAll.php";
require_once "../utils/formUtils.php";

preventAgency();
preventAdmin();

$crud = new CRUD_ADOPTION();

$id = $_SESSION["User"];

$apply = $crud->selectAdoptions("adopStatus = 'Apply' AND fk_adoptee_id = $id");
$approved = $crud->selectAdoptions("adopStatus = 'Approved' AND fk_adoptee_id = $id");
$declined = $crud->selectAdoptions("adopStatus = 'Declined' AND fk_adoptee_id = $id");

$pending = viewAdoptions($apply);
$accepted = viewAdoptions($approved);
$rejected = viewAdoptions($declined);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/main.css">
    <title>My adoptions</title>
</head>

<body>
    <?php include '../components/navbar.php'; ?>
    <div class="container">
        <h2>My adoption applications</h2>
        <?php include '../components/adoptionsAccordeon.php'; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>