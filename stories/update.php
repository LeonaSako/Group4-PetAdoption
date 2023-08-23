<?php
require_once "../utils/crudStories.php";
require_once "../utils/file_upload.php";
require_once "../utils/formUtils.php";
require_once "../components/breadcrumb.php";



addBreadcrumb('Dashboard', '../agency/dashboard.php');
addBreadcrumb('Pets', '../agency/repository.php');
addBreadcrumb('Update');

$pageTitle = "Update Story";  

session_start();
$id = $_GET["id"];
$crud = new CRUD_STORY();
$storiesUpdate = $crud->selectStories("id=$id");    
    foreach ($storiesUpdate as $story) {  
            $desccriptionUp = $story["desc"];
            $titleUp=$story["title"];
    }
    if (isset($_POST["update"])) {
        $title = $_POST['title'];
        $date = date("Y-m-d H:i:s");
        $desc = $_POST['desc'];
            $update = $crud->updateStory( $title,$desc,$date,$id);
        if ($update) {
            header("refresh:2; url = ../user/profile.php?id=" . $_SESSION["User"]);
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
        <h1 class="text-center">Update your story</h1>
        <form method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="optional-fields">
                <div class="mb-3">
                    <label for="title" class="form-label">Title </label>
                    <input type="text" class="form-control" id="breed" name="title" placeholder="Title" value="<?= $titleUp ?>">
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Description </label>
                    <textarea class="form-control" id="desc" name="desc" rows="4" cols="50" placeholder="Give a pet description" ><?= $desccriptionUp ?></textarea>
                </div>
            <div class="container">
                <div class="d-grid gap-2 d-md-flex justify-content-start">
                    <button name='update' type="submit" class="btn btn-primary">Update</button>
                    <a href="../user/profile.php?id="class="btn btn-warning">Back to dashboard</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>