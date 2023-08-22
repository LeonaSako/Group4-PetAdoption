<?php
session_start();

require_once "../utils/formUtils.php";
require_once "../utils/crudStories.php";

$pageTitle = "View Stories";
$crud = new CRUD_STORY();
$stories = $crud->selectStories("");    
$layout = "";
    foreach ($stories as $story) {  
            $image = "../images/pets/{$story['image']}";
            $desc = $story["desc"];
            $layout .= <<<HTML
                <div class='col-lg-3 col-md-4 col-sm-6'>
                    <div class='card'>
                        <img src="$image" alt="Pet-Photo" class="rounded-circle img-fluid" id="profile-picture">
                        <div class='card-body'>
                            <p class='card-text'>{$desc}</p>    
                        </div>
                    </div>
                </div>
   HTML;
}
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
        <input class="form-control w-50 m-auto" id="search" placeholder="Search user"> <br>
        <div id="layout" class="row">
            <?= $layout ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>