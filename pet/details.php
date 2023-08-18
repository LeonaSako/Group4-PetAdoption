<?php

session_start();

require_once "../utils/crudPet.php";

$id = $_GET["id"];

$crud = new CRUD_PET();

$result = $crud->selectPets("id = $id");

if (!empty($result)) {

    $pet = $result[0];
    $imageSrc = "../images/pets/{$pet['image']}";
    $name = $pet['name'];
    $breed = $pet['breed'];
    $age = $pet['age'];
    $size = $pet['size'];
    $vaccinated = ($pet['vaccinated'] == 1) ? 'Yes' : 'No';
    $location = $pet['location'];
    $description = $pet['description'];
    $status = ($pet['available'] == 1) ? 'Available' : 'Adopted';

    $layout = <<<HTML
    <div class="d-flex justify-content-md-evenly">
        <div class="card">
            <img src="{$imageSrc}" id="details-img" class='img-fluid shadow mb-5' alt="Pet image">
            <div class="card-body">
                <figure class="text-center">
                    <blockquote class="blockquote">
                        <h5>{$name}</h5>
                    </blockquote>
                    <figcaption class="blockquote-footer">
                    {$description}
                    </figcaption>
                </figure>
                <dl class="row">
                    <dt class="col-sm-4">Breed: </dt>
                    <dd class="col-sm-8">$breed</dd>
                    <dt class="col-sm-4">Age: </dt>
                    <dd class="col-sm-8">$age years old</dd>
                    <dt class="col-sm-4">Size: </dt>
                    <dd class="col-sm-8">$size</dd>
                    <dt class="col-sm-4">Vaccinated: </dt>
                    <dd class="col-sm-8">$vaccinated</dd>
                    <dt class="col-sm-4">Status: </dt>
                    <dd class="col-sm-8">$status</dd>
                </dl>
            </div>
        </div>
    </div>
    <br>
        <div class="d-grid gap-2 d-md-flex justify-content-center">
    HTML;
    if (isset($_SESSION["User"])) {
        $layout .= <<<HTML
                        <a href="../adoptions/new.php?id=$id" class="btn btn-warning">Adopt</a>
                        HTML;
    }
    if (isset($_SESSION["Adm"]) || isset($_SESSION["Agency"])) {
        $layout .= <<<HTML
                    <a href="update.php?id={$id}" class="btn btn-warning">Update</a>
                    <a href="delete.php?id={$id}" class="btn btn-danger">Delete</a>
                    HTML;
    }
    $layout .= "
        </div>
    ";
} else {
    $layout = "<p class='text-center'>Something went wrong. Record with id = $id is not found.</p>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/main.css">
    <title>Pet Details</title>
    <style>
        /* Additional styles for girly and pink look */
        body {
            background-color: #f9e1e1;
        }

        h1 {
            color: #ff69b4;
        }

        .card {
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            max-width: 400px;
            padding: 20px;
        }

        .card img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        a {
            color: #ff69b4;
            text-decoration: none;
            transition: color 0.3s;
        }

        a:hover {
            color: #ff4181;
        }
    </style>
</head>

<body>

    <?php include '../components/navbar.php'; ?>
    <div class="container mt-4">
        <a href="listings.php">GO BACK</a>
        <h1 class="text-center">Animal Details</h1>
        <div class="row justify-content-center">
            <?= $layout ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>