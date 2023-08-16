<?php

session_start();

require_once "../utils/crud.php";

$id = $_GET["id"];

$crud = new CRUD();

$result = $crud->selectPets("id = $id");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animal Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <?php include '../components/navbar.php'; ?>

    <div class="container mt-4">
        <a href="javascript:history.back()">GO BACK</a>
        <h1 class="text-center">Animal Details</h1>
        <div class="row justify-content-center">
            <?php
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
            ?>
            <div class="col-md-6">
                <div class="card">
                    <img src="<?php echo $imageSrc; ?>" class="card-img-top"
                        style="max-width: 100%; max-height: 400px; min-height: 400px;" alt="Animal Photo">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $name; ?></h5>
                        <p class="card-text">Breed: <?php echo $breed; ?></p>
                        <p class="card-text">Age: <?php echo $age; ?> years</p>
                        <p class="card-text">Size: <?php echo $size; ?></p>
                        <p class="card-text">Vaccinated: <?php echo $vaccinated; ?></p>
                        <p class="card-text">Location: <?php echo $location; ?></p>
                        <p class="card-text">Description: <?php echo $description; ?></p>
                    </div>
                </div>
            </div>
            <?php
            } else {
                echo "<p class='text-center'>Animal not found.</p>";
            }
            ?>
        </div>
    </div>
</body>

</html>
