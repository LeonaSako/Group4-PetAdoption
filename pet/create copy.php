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

$age = $breed = $description = $size = $location = $behavior = "";

$attr_required = $attr_next = $select_dog = $select_cat = $select_bird = $select_fish = $experience = $status = $vaccine = "";
$attr_optional = $attr_create = $attr_back = "hidden";
$req_attr = "required";

$name = (isset($_POST['name'])) ? cleanInputs($_POST['name']) : '';
$minSpace = (isset($_POST['minSpace'])) ? cleanInputs($_POST['minSpace']) : '';
$species = (isset($_POST['species'])) ? $_POST['species'] : '';
$select_dog = ($species == 'Dog') ? "selected" : "";
$select_cat = ($species == 'Cat') ? "selected" : "";
$select_bird = ($species == 'Bird') ? "selected" : "";
$select_fish = ($species == 'Fish') ? "selected" : "";
$exp = isset($_POST["experience"]) ? 1 : 0;
$available = isset($_POST["status"]) ? 1 : 0;
$vaccinated = isset($_POST["vaccine"]) ? 1 : 0;
$experience = ($exp == 1) ? 'checked' : '';
$status = ($available == 1) ? 'checked' : '';
$vaccine = ($vaccinated == 1) ? 'checked' : '';

if (isset($_POST["next"])) {

    $name = cleanInputs($_POST['name']);
    $species = $_POST['species'];
    $minSpace = cleanInputs($_POST['minSpace']);
    $exp = isset($_POST["experience"]) ? 1 : 0;
    $available = isset($_POST["status"]) ? 1 : 0;
    $vaccinated = isset($_POST["vaccine"]) ? 1 : 0;

    $attr_required = $attr_next = "hidden";
    $attr_optional = $attr_create = $attr_back = $req_attr = "";

    $select_dog = ($species == 'Dog') ? "selected" : "";
    $select_cat = ($species == 'Cat') ? "selected" : "";
    $select_bird = ($species == 'Bird') ? "selected" : "";
    $select_fish = ($species == 'Fish') ? "selected" : "";
    $experience = ($exp == 1) ? 'checked' : '';
    $status = ($available == 1) ? 'checked' : '';
    $vaccine = ($vaccinated == 1) ? 'checked' : '';

    if (isset($_POST["create"])) {

        $location = cleanInputs($_POST['location']);
        $breed = $_POST['breed'];
        $age = $_POST['age'];
        $size = $_POST['size'];
        $description = $_POST['desc'];
        $behavior = cleanInputs($_POST['behavior']);
        $image = fileUpload($_FILES["image"], 'pet');

        $values = [$name, $image[0], $location, $species, $breed, $age, $size, $available, $description, $vaccinated, $exp, $minSpace, $behavior, $userID];

        foreach ($values as $value) {
            echo $value . ' ';
        }

        $crud->createPet($values);
    } else if (isset($_POST["back"])) {
        $attr_required = $attr_next = "";
        $attr_optional = $attr_create = $attr_back = "hidden";
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
        <form method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="card">
                <div class="card-header">
                    <h2>New pet</h2>
                </div>
                <div class="card-body">
                    <div class="required-fields" <?= $attr_required ?>>
                        <div class="mb-3 mt-3">
                            <label for="name" class="form-label">Name <span class='required'>*</span> </label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?= $name ?>" <?= $req_attr ?> oninvalid="this.setCustomValidity('Please, add a pet name')" oninput="setCustomValidity('')">
                        </div>
                        <div class="mb-3">
                            <label for="species" class="form-label">Species <span class='required'>*</span></label>
                            <select class="form-control" id="species" name="species" <?= $req_attr ?> oninvalid="this.setCustomValidity('Please, select a pet species')" oninput="setCustomValidity('')">
                                <option value="" disabled selected>Select</option>
                                <option value="Dog" <?= $select_dog ?>>Dog</option>
                                <option value="Cat" <?= $select_cat ?>>Cat</option>
                                <option value="Bird" <?= $select_bird ?>>Bird</option>
                                <option value="Fish" <?= $select_fish ?>>Fish</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="space" class="form-label">Space needed <span class='required'>*</span></label>
                            <input type="number" class="form-control" id="space" name="minSpace" placeholder="Space" min="0" <?= $req_attr ?> value="<?= $minSpace ?>" oninvalid="this.setCustomValidity('Please, add the amount of space needed')" oninput="setCustomValidity('')">
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="experience" <?= $experience ?>>
                                <label class="form-label form-check-label" for="experience">Experience with pets needed? <span class='required'>*</span></label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="status" <?= $status ?>>
                                <label class="form-label form-check-label" for="status">Is the pet available for adoption? <span class='required'>*</span></label>
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
                    <div class="optional-fields" <?= $attr_optional ?>>
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

                    <div class="gap-2 d-md-flex justify-content-center">
                        <a href="../admin/dashboard.php" class="btn btn-warning">Back to dashboard</a>
                        <button name='next' type="submit" class="btn btn-primary" <?= $attr_next ?>>Next</button>
                        <button name='back' type="submit" class="btn btn-primary" <?= $attr_back ?>>Back</button>
                        <button name='create' type="submit" class="btn btn-primary" <?= $attr_create ?>>Create</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>