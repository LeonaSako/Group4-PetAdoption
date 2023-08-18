<?php
session_start();

require_once "../utils/crudPet.php";
require_once "../pet/viewAll.php";

$crud = new CRUD_PET();
$layout = "";

if (isset($_POST["finish"])) {

    $animalPreference = $_POST["animalPreference"];
    $sizePreference = $_POST["sizePreference"];
    $result = $crud->selectPets("species = '$animalPreference' AND size = '$sizePreference'");

    $layout = viewPets($result);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Compatibility Quiz</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/main.css">

</head>

<body>

    <?php include '../components/navbar.php'; ?>
    <header class="header">
        <h2>Compatibility quiz</h2>
    </header>
    <a class="m-3 btn btn-primary" href="javascript:history.back()">GO BACK</a>
    <div class="container">

        <div class="card ">
            <div class="card-header">
                Compatibility Quiz
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="mb-3">
                        <label for="animalPreference" class="form-label">Which animal do you prefer?</label>
                        <select class="form-select" name="animalPreference" required>
                            <option value="Cat">Cat</option>
                            <option value="Dog">Dog</option>
                            <option value="Bird">Bird</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="sizePreference" class="form-label">What size are you looking for?</label>
                        <select class="form-select" name="sizePreference" required>
                            <option value="Small">Small</option>
                            <option value="Medium">Medium</option>
                            <option value="Large">Large</option>
                        </select>
                    </div>
                    <button type="submit" name='finish' class="btn btn-primary">Finish Quiz</button>
                </form>
            </div>
        </div>
        <div class="container">
            <?= $layout ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>