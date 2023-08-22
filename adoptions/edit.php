<?php
require_once "../utils/crudAdoption.php";
require_once "../utils/file_upload.php";
require_once "../utils/formUtils.php";

$pageTitle = "Edit adoption";

// session_start();
// preventUser();

$id = $_GET["id"];
$status = $_GET["status"];

$crudAdoption = new CRUD_ADOPTION();




    $id = $_GET["id"];
    $status = $_GET["status"];

    $update = $crudAdoption->updateAdoptionStatus($id, $status, "WHERE id = $id");


    header("refresh: 3; url = ../agency/adoptions.php");

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
    <!-- Add layout -->
    <h1> Test {{$id }} </h1> 
</body>

</html>