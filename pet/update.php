<?php
require_once "../utils/crudPet.php";
require_once "../utils/file_upload.php";
require_once "../utils/formUtils.php";

$pageTitle = "Update details";

session_start();
preventUser();

if (isset($_SESSION["Adm"])) {
    $userID = $_SESSION["Adm"];
} else {
    $userID = $_SESSION["Agency"];
}

$id = $_GET["id"];

$crud = new CRUD_PET();

$result = $crud->selectPets("id = $id");

if (!empty($result)) {

    $pet = $result[0];
    $experience = ($pet["experienceNeeded"] == 1) ? 'checked' : '';
    $available = ($pet["available"] == 1) ? 'checked' : '';
    $vaccine = ($pet["vaccinated"] == 1) ? 'checked' : '';

    if (isset($_POST["update"])) {
        $name = $_POST['name'];
        $species = $_POST['species'];
        $location = $_POST['location'];
        $status = isset($_POST["available"]) ? 1 : 0;
        $experience = isset($_POST["experience"]) ? 1 : 0;
        $minSpace = $_POST['space'];
        $vaccinated = isset($_POST["vaccine"]) ? 1 : 0;
        $breed = $_POST['breed'];
        $age = $_POST['age'];
        $size = $_POST['size'];
        $description = $_POST['desc'];
        $behavior = $_POST['behavior'];
        $image = fileUpload($_FILES["image"], 'pet');

        if ($_FILES["image"]["error"] == 0) {
            removeOldPetImage($pet["image"]);
            $update = $crud->updatePet($id, $name, $location, $species, $breed, $age, $size, $description, $status, $vaccinated, $experience, $minSpace, $behavior, $image[0]);
        } else {
            $update = $crud->updatePet($id, $name, $location, $species, $breed, $age, $size, $description, $status, $vaccinated, $experience, $minSpace, $behavior, Null);
        }
        if ($update) {
            header("refresh: 2; url = ../pet/details.php?id=" . $pet["id"]);
        }
    }
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
        <h1 class="text-center">Update animal record</h1>
        <form method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="required-fields">
                <h6 id=pet-details-h6>Required pet details</h6>
                <div class="mb-3 mt-3">
                    <label for="name" class="form-label">Name <span class='required'>*</span> </label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?= $pet["name"] ?>" required="" oninvalid="this.setCustomValidity('Please, add a pet name')" oninput="setCustomValidity('')">
                </div>
                <div class="mb-3">
                    <label for="species" class="form-label">Species <span class='required'>*</span></label>
                    <select class="form-control" id="species" name="species" required="" oninvalid="this.setCustomValidity('Please, select a pet species')" oninput="setCustomValidity('')">
                        <option value="" disabled <?php echo ($pet["species"] === NULL) ? "selected" : ""; ?>>Select</option>
                        <option value="Dog" <?php echo ($pet["species"] === "Dog") ? "selected" : ""; ?>>Dog</option>
                        <option value="Cat" <?php echo ($pet["species"] === "Cat") ? "selected" : ""; ?>>Cat</option>
                        <option value="Bird" <?php echo ($pet["species"] === "Bird") ? "selected" : ""; ?>>Bird</option>
                        <option value="Fish" <?php echo ($pet["species"] === "Fish") ? "selected" : ""; ?>>Fish</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="space" class="form-label">Space needed <span class='required'>*</span></label>
                    <input type="number" class="form-control" id="space" name="space" placeholder="Space" min="0" value="<?= $pet["minSpace"] ?>" required="" oninvalid="this.setCustomValidity('Please, add the amount of space needed')" oninput="setCustomValidity('')">
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="experience" <?= $experience ?>>
                        <label class="form-label form-check-label" for="experience">Experience with pets needed? <span class='required'>*</span></label>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="available" <?= $available ?>>
                        <label class="form-label form-check-label" for="available">Is the pet available for adoption? <span class='required'>*</span></label>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="vaccine" <?= $vaccine ?>>
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
                    <input type="text" class="form-control" id="breed" name="breed" placeholder="Breed" value="<?= $pet["breed"] ?>">
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Description </label>
                    <textarea class="form-control" id="desc" name="desc" rows="4" cols="50" placeholder="Give a pet description"><?= $pet["description"] ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="size" class="form-label">Size</label>
                    <select class="form-control" id="size" name="size">
                        <option value="" disabled <?php echo ($pet["size"] === NULL) ? "selected" : ""; ?>>Select</option>
                        <option value="Small" <?php echo ($pet["size"] === "Small") ? "selected" : ""; ?>>Small</option>
                        <option value="Medium" <?php echo ($pet["size"] === "Medium") ? "selected" : ""; ?>>Medium</option>
                        <option value="Large" <?php echo ($pet["size"] === "Large") ? "selected" : ""; ?>>Large</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="age" class="form-label">Age </label>
                    <input type="number" class="form-control" id="age" name="age" placeholder="Age" min="0" value="<?= $pet["age"] ?>">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image </label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" class="form-control" id="location" name="location" placeholder="Location" value="<?= $pet["location"] ?>">
                </div>
                <div class="mb-3">
                    <label for="behavior" class="form-label">Behavior </label>
                    <textarea class="form-control" id="behavior" name="behavior" rows="4" cols="50" placeholder="Give a pet behavior"><?= $pet["behavior"] ?></textarea>
                </div>
            </div>
            <div class="container">
                <div class="d-grid gap-2 d-md-flex justify-content-start">
                    <button name='update' type="submit" class="btn btn-primary">Update pet</button>
                    <a href="../admin/dashboard.php" class="btn btn-warning">Back to dashboard</a>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>