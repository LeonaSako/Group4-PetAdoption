<?php
session_start();

require_once "../utils/crud.php";
require_once "../utils/file_upload.php";
require_once "../utils/formUtils.php";

preventUser();

# This checks who is creating the pet (Admin or Agency) and sets the value of the user's ID 

if (isset($_SESSION["Adm"])) {
    $userID = $_SESSION["Adm"];
} else {
    $userID = $_SESSION["Agency"];
}

$crud = new CRUD();
// "`name`, `image`, `location`, `species`, `breed`, `age`, `size`, `description`, `vaccinated`, `experienceNeeded`, `minSpace`, `behavior`, `fk_users_id`", $values);

$name = $breed = $desc = $age = $location = $vaccine = "";

if (isset($_POST["create"])) {

    $name = $_POST["name"];
    $image = fileUpload($_FILES["image"], 'pet');
    $location = $_POST["location"];
    $species = $_POST["species"];
    $breed = $_POST["breed"];
    $age = $_POST["age"];
    $size = $_POST["size"];
    $desc = $_POST["description"];
    $vaccine = $_POST["vaccinated"];
    $experience = $_POST["experienceNeeded"];
    $space = $_POST["minSpace"];
    $behavior = $_POST["behavior"];
    $age = $_POST["age"];
    
    $vaccine = isset($_POST['vaccine']) ? $_POST['vaccine'] : NULL;
    

    $values = [$name, $image[0], $location, $species, $breed, $age,$size, $desc, $vaccine, $experience, $space, $behavior, $userid];

    $create = $crud->createPet($values);

    if ($create) {
        header("refresh: 3; url = ../dashboard.php");
    }
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
            <div class="mb-3 mt-3">
                <label for="name" class="form-label">Name </label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?= $name ?>" required>
            </div>
            <div class="mb-3">
                <label for="species" class="form-label">Species</label>
                <select class="form-control" id="species" name="species">
                    <option value="" disabled selected>Select</option>
                    <option value="Cat">Cat</option>
                    <option value="Dog">Dog</option>
                    <option value="Bird">Bird</option>
                    <option value="Bird">Fish</option>
                </select>
            </div>
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
                <select name="experienced" id="experienced">
                    <label for="experienced">Is experience with pets needed?</label>
                <option name="experienced" value="Yes">Yes</option>
                <option name="experienced" value="No">No</option>
                </select>
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
            <button name="create" type="submit" class="btn btn-primary">Submit</button>
            <a href="../dashboard.php" class="btn btn-warning">Back to dashboard</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>