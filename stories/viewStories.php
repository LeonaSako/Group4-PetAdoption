<?php
session_start();

require_once "../utils/formUtils.php";
require_once "../utils/crudUser.php";
require_once "../utils/crudAdoption.php";
require_once "../utils/crudStories.php";
require_once "../components/usertable.php";
require_once "../utils/crudPet.php";
require_once "../components/breadcrumb.php";

$pageTitle = "View Stories";

$crud = new CRUD_STORY();

$stories = $crud->selectStories("");    
$layout = "";
    foreach ($stories as $story) {  
            $image = "../images/stories/{$story['image']}";
            $desc = $story["desc"];
            $title=$story["title"];
            $layout .= <<<HTML
                <div class='col-lg-2'>
                    <div class='card '>
                        <img src="$image" alt="Pet-Photo" class="img-fluid" id="profile-picture">
                    </div>
                </div>
                <div class='col-lg-10'>
                    <div class='card '>
                        <div class="card-header">
                            <p class="text-muted mb-0"><h5> $title</h5></p>
                        </div>
                            <div class="col-sm-12">
                                <div class="storyDescr"> $desc</div>
                            </div>
                    </div>
                </div>
                <hr>
   HTML;
} 

addBreadcrumb('Home', '../home.php');
addBreadcrumb('Stories');

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