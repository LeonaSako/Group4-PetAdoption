<?php
require_once "../utils/crud.php";
require_once "../utils/formUtils.php";

session_start();
preventUser();
preventAgency();

$crud = new CRUD();

$results = $crud->selectUsers("role != 'Adm'");

$getAdmin = $crud->selectUsers("id = {$_SESSION["Adm"]}");

$admin = $getAdmin[0];

$layout = "";

if (!empty($results)) {

    foreach ($results as $user) {

        $imageSrc = "pictures/{$user["image"]}";
        $firstName = $user["firstName"];
        $lastName = $user["lastName"];
        $email = $user["email"];
        $userid = $user["id"];

        $layout .= <<<HTML
            <div class='col-lg-3 col-md-4 col-sm-6'>
                <div class='card'>
                    <img src='{$imageSrc}' class='img-fluid'>
                    <div class='card-body'>
                        <h5 class='card-title'>{$firstName} {$lastName}</h5>
                        <p class='card-text'>{$email}</p>
                        <a href='user/update.php?id={$userid}' class='btn btn-warning'>Update</a>
                    </div>
                </div>
            </div>
        HTML;
    }
} else {
    $layout .= "No results found!";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/main.css">
    <title>Document</title>
</head>

<body>
    <?php include '../components/navbar.php'; ?>
    <h2 class="text-center"> Welcome <?= $admin["firstName"] . " " . $admin["lastName"] ?></h2>

    <div class="container">
        <input class="form-control w-50 m-auto" id="search" placeholder="Search user"> <br>
        <div id="layout" class="row">
            <?= $layout ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>