<?php
session_start();

require_once "../utils/crudPet.php";
require_once "../utils/file_upload.php";
require_once "../utils/formUtils.php";
require_once "../components/breadcrumb.php";

$pageTitle = "Add pet";

addBreadcrumb('Dashboard', '../agency/dashboard.php');
addBreadcrumb('Pets', '../agency/repository.php');
addBreadcrumb('New');
preventUser();

if (isset($_SESSION["Adm"])) {
    $userID = $_SESSION["Adm"];
} else {
    $userID = $_SESSION["Agency"];
}

$crud = new CRUD_PET();

$name = $breed = $description = $location = $behavior = "";

if (isset($_POST["create"])) {

    $name = cleanInputs($_POST['name']);
    $species = cleanInputs($_POST['species']);
    $location = cleanInputs($_POST['location']);
    $available = isset($_POST["status"]) ? 1 : 0;
    $exp = isset($_POST["experience"]) ? 1 : 0;
    $minSpace = $_POST['minSpace'];
    $vaccinated = isset($_POST["vaccine"]) ? 1 : 0;
    $breed = $_POST['breed'];
    $age = $_POST['age'];
    $size = $_POST['size'];
    $description = $_POST['desc'];
    $behavior = cleanInputs($_POST['behavior']);
    $image = fileUpload($_FILES["image"], 'pet');

    $values = [$name, $image[0], $location, $species, $breed, $age, $size, $available, $description, $vaccinated, $exp, $minSpace, $behavior, $userID];

    $crud->createPet($values);
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
        <form method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="required-fields">
                <h6 id=pet-details-h6>Required pet details</h6>
                <div class="mb-3 mt-3">
                    <label for="name" class="form-label">Name <span class='required'>*</span> </label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?= $name ?>" required="" oninvalid="this.setCustomValidity('Please, add a pet name')" oninput="setCustomValidity('')">
                </div>
                <div class="mb-3">
                    <label for="species" class="form-label">Species <span class='required'>*</span></label>
                    <select class="form-control" id="species" name="species" required="" oninvalid="this.setCustomValidity('Please, select a pet species')" oninput="setCustomValidity('')">
                        <option value="" disabled selected>Select</option>
                        <option value="Dog">Dog</option>
                        <option value="Cat">Cat</option>
                        <option value="Bird">Bird</option>
                        <option value="Fish">Fish</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="space" class="form-label">Space needed <span class='required'>*</span></label>
                    <input type="number" class="form-control" id="space" name="minSpace" placeholder="Space" min="0" value="<?= $minSpace ?>" required="" oninvalid="this.setCustomValidity('Please, add the amount of space needed')" oninput="setCustomValidity('')">
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="experience">
                        <label class="form-label form-check-label" for="experience">Experience with pets needed? <span class='required'>*</span></label>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="status">
                        <label class="form-label form-check-label" for="status">Is the pet available for adoption? <span class='required'>*</span></label>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="vaccine">
                        <label class="form-label form-check-label" for="vaccine">Is the pet vaccinated? <span class='required'>*</span></label>
                    </div>
                </div>
                <p>(<span class='required'>*</span>) Required fields</p>
            </div>
            <br>
            <div class="optional-fields">
                <h6 id=pet-details-h6>Optional pet details</h6>
                <div class="mb-3">
                    <label for="breed" class="form-label">Breed </label>
                    <input type="text" class="form-control" id="breed" name="breed" placeholder="Breed" value="<?= $breed ?>">
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Description </label>
                    <textarea class="form-control" id="desc" name="desc" rows="4" cols="50" placeholder="Give a pet description"><?= $description ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="size" class="form-label">Size</label>
                    <select class="form-control" id="size" name="size">
                        <option value="" disabled selected>Select</option>
                        <option value="Small">Small</option>
                        <option value="Medium">Medium</option>
                        <option value="Large">Large</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="age" class="form-label">Age </label>
                    <input type="number" class="form-control" id="age" name="age" placeholder="Age" min="0" value="<?= $age ?>">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image </label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" class="form-control" id="location" name="location" placeholder="Location" value="<?= $location ?>">
                </div>

                <div class="mb-3">
                    <label for="behavior" class="form-label">Behavior </label>
                    <textarea class="form-control" id="behavior" name="behavior" rows="4" cols="50" placeholder="Give a pet behavior"><?= $behavior ?></textarea>
                </div>
            </div>
            <br>
            <div class="container">
                <div class="d-grid gap-2 d-md-flex justify-content-start">
                    <button name='create' type="submit" class="btn btn-primary">Create</button>
                    <a href="../admin/dashboard.php" class="btn btn-warning">Back to dashboard</a>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>