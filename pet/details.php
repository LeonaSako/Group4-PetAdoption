<?php

session_start();

require_once "../utils/crud.php";

$id = $_GET["id"];

$crud = new CRUD();

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

    $layout = <<<HTML
    <div class="col-md-6">
        <div class="card">
            <img src="<?php echo $imageSrc; ?>" class="card-img-top" style="max-width: 100%; max-height: 400px; min-height: 400px;" alt="Animal Photo">
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
    <div class="container">
        <div class="d-grid gap-2 d-md-flex justify-content-center">
            <a href="update.php?id={$id}" class="btn btn-primary">Update</a>
            <a href="delete.php?id={$id}" class="btn btn-danger">Delete</a>
            <a href="../dashboard.php" class="btn btn-warning">Back to dashboard</a>
        </div>
    </div>
HTML;
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
    <title>Animal Details</title>
</head>

<body>
    <?php include '../components/navbar.php'; ?>
    <div class="container mt-4">
        <a href="javascript:history.back()">GO BACK</a>
        <h1 class="text-center">Animal Details</h1>
        <div class="row justify-content-center">
            <?= $layout ?>
        </div>
    </div>
</body>

</html>