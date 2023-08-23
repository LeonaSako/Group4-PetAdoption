<?php
session_start();

require_once "../utils/crudPet.php";
require_once "../pet/viewAll.php";
require_once "../components/breadcrumb.php";

$pageTitle = "Pet care";

addBreadcrumb('Home', '../home.php');
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
<<<<<<< HEAD
        <div id="layout" class="row m-2">
            <div class="col-4">
                <div class="card" style="width: 18rem;">
                    <img src="../images/pets/dog.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">If you want take care of me, You can click read more.</p>
                        <a href="dog.php" class="btn btn-primary">Care</a>
                        <br><br>
                        <a href="trainingdog.php" class="btn btn-primary">Training & Tips</a>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card" style="width: 18rem;">
                    <img src="../images/pets/bird.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">If you want take care of me, You can click read more.</p>
                        <a href="bird.php" class="btn btn-primary">Care</a>
                        <br><br>
                        <a href="trainingbird.php" class="btn btn-primary">Training & Tips</a>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card" style="width: 18rem;">
                    <img src="../images/pets/cat.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">If you want take care of me, You can click read more.</p>
                        <a href="cat.php" class="btn btn-primary">Care</a>
                        <br><br>
                        <a href="trainingcat.php" class="btn btn-primary">Training & Tips</a>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card" style="width: 18rem;">
                    <img src="../images/pets/fish.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">If you want take care of me, You can click read more.</p>
                        <a href="fish.php" class="btn btn-primary">Care</a>
                        <br><br>
                        <a href="trainingfish.php" class="btn btn-primary">Training & Tips</a>
                    </div>
                </div>
            </div>
=======
       <div id="content" class="row row-cols-lg-4 row-cols-md-3 row-cols-sm- row-cols-xs-1 gap-3">
       
>>>>>>> 18ac472f6094f6370c7a291ee4a8d05b2b66482e
        </div>
      </div>
    <script src="static.js"></script>
</body>

</html>