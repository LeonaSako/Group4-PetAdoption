<?php
session_start();

require_once "../utils/crudStories.php";
require_once "../utils/formUtils.php";
require_once "../utils/file_upload.php";

$pageTitle = "Pet story";
$petId = $_GET["id"];
$userId = $_SESSION["User"];

$crud = new CRUD_STORY();

if (isset($_POST["create"])) {
    // $date = date('Y-m-d');
    $date = date("Y-m-d H:i:s");
    $description = $_POST['desc'];
    $image = fileUpload($_FILES["image"],'stories');
    $values = [$petId,$image[0],$date,$description,$userId];
    $crud->createStory($values);    
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
        <h1 class="text-center">Add your story</h1>
        <form method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="optional-fields">
                <div class="mb-3">
                    <label for="desc" class="form-label">Description </label>
                    <textarea class="form-control" id="desc" name="desc" rows="4" cols="50" placeholder=""></textarea>
                </div>
                <div class="mb-3"></div>
                <div class="mb-3"></div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image </label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
            </div>
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