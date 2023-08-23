<?php
session_start();

require_once "../utils/crudPet.php";
require_once "../pet/viewAll.php";
require_once "../components/breadcrumb.php";

$pageTitle = "Pet care";

addBreadcrumb('Home', '../user/dashboard.php');
addBreadcrumb('Pets', '../pet/listings.php');
addBreadcrumb('Pet care');

?>

<!doctype html>
<html lang="en">

<head>
    <?php include '../components/head.php'; ?>
    <link rel="stylesheet" href="../css/main.css">
    <title><?= $pageTitle ?></title>
</head>

<body>
    <?php include '../components/navbar.php'; ?>
    

    <div class="container">
        <h2 class="h2-header">How to take care of animals</h2>
       <div id="content" class="row row-cols-lg-4 row-cols-md-3 row-cols-sm- row-cols-xs-1 gap-3">
       
        </div>
      </div>
    <script src="static.js"></script>
</body>

</html>