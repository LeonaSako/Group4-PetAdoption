<?php
session_start();

require_once "../utils/crud.php";
require_once "../utils/file_upload.php";
require_once "../utils/formUtils.php";

preventUser();

if (isset($_SESSION["Adm"])) {
    $userID = $_SESSION["Adm"];
} else {
    $userID = $_SESSION["Agency"];
}

$crud = new CRUD();

$name = $breed = $desc = $age = $location = $vaccine = $space = $behavior= "";

if (isset($_POST["create"])) {

    $name = isset($_POST['name']) ? cleanInputs($_POST["name"]) : '';
    
    $location = isset($_POST['location']) ? cleanInputs($_POST["location"]) : NULL;
    $species = $_POST["species"];
    $breed = isset($_POST['breed']) ? $_POST["breed"] : NULL;
    $age = isset($_POST['age']) ? $_POST["age"] : NULL;
    $size = isset($_POST['size']) ? $_POST["size"] : NULL;
    $desc = isset($_POST['description']) ? $_POST["description"] : NULL;
    $vaccine = isset($_POST['vaccinated']) ? $_POST["vaccinated"] : '';
    $experience = isset($_POST['experienceNeeded']) ? $_POST["experienceNeeded"] : '';
    $space = isset($_POST['minSpace']) ? $_POST["minSpace"] : '';
    $behavior = isset($_POST['behavior']) ? cleanInputs($_POST["behavior"]) : NULL;
    
    $image = fileUpload($_FILES["image"], 'pet');
    
    $values = [$name, $image[0], $location, $species, $breed, $age,$size, $desc, $vaccine, $experience, $space, $behavior, $userID];

    $create = $crud->createPet($values);

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
    <div class="container">
        <h1 class="text-center">Create a new animal record</h1>
        <form method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="required-fields">
                <h6 id=pet-details-h6>Required pet details</h6>
                <div class="mb-3 mt-3">
                    <label for="name" class="form-label">Name <span class='required'>*</span> </label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?= $name ?>" required="" oninvalid="this.setCustomValidity('Please, add a pet name')" oninput="setCustomValidity('')" >
                </div>
                <div class="mb-3">
                    <label for="species" class="form-label">Species <span class='required'>*</span></label>
                    <select class="form-control" id="species" name="species"  required="" oninvalid="this.setCustomValidity('Please, select a pet species')" oninput="setCustomValidity('')" >
                        <option value="" disabled selected>Select</option>
                        <option value="Cat">Cat</option>
                        <option value="Dog">Dog</option>
                        <option value="Bird">Bird</option>
                        <option value="Bird">Fish</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="space" class="form-label">Space needed <span class='required'>*</span></label>
                    <input type="number" class="form-control" id="space" name="space" placeholder="Space" min="0" value="<?= $space ?>" required="" oninvalid="this.setCustomValidity('Please, add the amount of space needed')" oninput="setCustomValidity('')">
                </div>
                <div class="mb-3">
                    <label for="experienced" class="form-label">Is experience with pets needed? <span class='required'>*</span></label>
                    <select class="form-control" id="experience" name="experience"  required="" oninvalid="this.setCustomValidity('Please, select if experience is needed')" oninput="setCustomValidity('')" >
                        <option value="" disabled selected>Select</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
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
                    <textarea class="form-control" id="desc" name="desc" rows="4" cols="50" placeholder="Give an animal description" value="<?= $desc ?>"></textarea>
                </div>
                <div class="mb-3">
                    <label for="size" class="form-label">Size</label>
                    <select class="form-control" id="size" name="size">
                        <option value="" disabled selected>Select</option>
                        <option value="small">small</option>
                        <option value="medium">medium</option>
                        <option value="large">large</option>
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
                    <label for="vaccine" class="form-label">Vaccination</label>
                    <select class="form-control" id="vaccine" name="vaccine">
                        <option value="" disabled selected>Select</option>
                        <option value="yes">yes</option>
                        <option value="no">no</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="behavior" class="form-label">Behavior </label>
                    <textarea class="form-control" id="behavior" name="behavior" rows="4" cols="50" placeholder="Give an animal behavior" value="<?= $behavior ?>"></textarea>
                </div>
            </div>
            <br>
            <button name="create" type="submit" class="btn btn-primary">Submit</button>
            <a href="../dashboard.php" class="btn btn-warning">Back to dashboard</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>