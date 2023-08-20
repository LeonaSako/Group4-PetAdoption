<?php
session_start();

require_once "../utils/crudPet.php";
require_once "../pet/viewAll.php";

$pageTitle = "Quiz";

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
    <?php include '../components/head.php'; ?>
    <link rel="stylesheet" href="../css/main.css">
    <title><?= $pageTitle ?></title>
</head>

<body>

    <?php include '../components/navbar.php'; ?>

    <div class="container">
        <a class="btn btn-primary back" href="javascript:history.back()">GO BACK</a>
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