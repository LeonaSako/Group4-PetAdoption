<?php

session_start();

require_once "../utils/crudUser.php";
require_once "../utils/crudAdoption.php";
require_once "../utils/crudStories.php";
require_once "../components/usertable.php";
require_once "../utils/crudPet.php";
require_once "../components/breadcrumb.php";

$pageTitle = "Profile";

$id = 0;
if(isset($_SESSION["User"])){
    $id = $_SESSION["User"];
}elseif(isset($_SESSION["Admin"])){
    $id = $_SESSION["Admin"];
}elseif(isset($_SESSION["Agency"])){
    $id = $_SESSION["Agency"];
}



$crud = new CRUD_USER();

$result = $crud->selectUsers("id = $id");

$url = "../user/update.php?id=$id";

if (!empty($result)) {

    $user = $result[0];
    $imageSrc = "../images/users/{$user['image']}";
    $name = $user['firstName'] . ' ' . $user['lastName'];
    $address = $user['address'];
    $birthdate = $user['birthdate'];
    $phone = $user['phone'];
    $email = $user['email'];
    $agency = $user['agency'];

    $crudAdoption = new CRUD_ADOPTION();

    $applications = $crudAdoption->selectAdoptions("fk_adoptee_id = $id");
    $applic = viewAdoptions($applications);
}

if (isset($_SESSION['User']) || isset($_SESSION['Adm'])) {
    addBreadcrumb('Home', '../user/dashboard.php');
} elseif (isset($_SESSION['Agency'])) {
    addBreadcrumb('Home', '../agency/dashboard.php');
}

if (isset($_SESSION['User']) || isset($_SESSION['Adm'])) {
    addBreadcrumb('User', '../user/profile.php?id=' . $id);
} elseif (isset($_SESSION['Agency'])) {
    addBreadcrumb('Agency', '../user/profile.php?id=' . $id);
}
addBreadcrumb('Profile');
$crud = new CRUD_STORY();
$stories = $crud->selectStories("");    
    foreach ($stories as $story) {  
            $image = "../images/stories/{$story['image']}";
            $desc = $story["desc"];
            $title=$story["title"];
            $date=$story["date"];
            $userId =$story["id"];
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
    <section>
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="<?php echo $imageSrc; ?>" alt="avatar" class="rounded-circle img-fluid" id="profile-picture">
                            <h5 class="my-3"><?php echo $name; ?></h5>
                     
                            <div class="d-flex justify-content-center mb-2">
                                <a href="<?php echo $url; ?>" class="btn btn-primary">Update</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header">
                            Profile details
                        </div>
                        <div class="card-body">
                       
                            <div class="row">
                                <div class="col-sm-3">
                                    
                                    <?php if (isset($_SESSION['User']) || isset($_SESSION['Adm'])) { ?>
                                        <p class="mb-0">Full Name</p>
                                            </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0"><?php echo $name; ?></p>
                                    <?php } ?>
                                    <?php if (isset($_SESSION['Agency'])) { ?>
                                        <p class="mb-0">Agency Name</p>
                                            </div>
                                        <div class="col-sm-9">    
                                            <p class="text-muted mb-0"><?php echo $agency; ?></p>
                                    <?php } ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo $email; ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Phone</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo $phone; ?></p>
                                </div>
                            </div>
                            <hr>
                            <?php if (isset($_SESSION['User']) || isset($_SESSION['Adm'])) { ?>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Birthdate</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo $birthdate; ?></p>
                                </div>
                            </div>
                            <hr>
                            <?php } ?>

                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Address</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo $address; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         
            
            <?php if (isset($_SESSION['User'])) { ?>
             
            <div class="row">
                <div class="col">
                    <div class="card mb-4">
                        <div class="card-header">
                            My adoption applications
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">Pet Name</th>
                                        <th scope="col">Species</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Submission Date</th>
                                        <th scope="col">Donation</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?= $applic ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
           <?php } ?>
        </div>
    </section>
    <section <? ?>
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <div class="card mb-4">
                        <div class="card-header">
                            My adoption stories
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td scope="col"><?=$title?></td>
                                    <td scope="col"><?=$date?></td>
                                    <td scope="col">
                                        <p class="d-inline-flex gap-1">
                                        <a href="../stories/mystory.php?id=<?=$userId ?>" class="btn btn-warning">Show</a>
                                        <a href="../stories/update.php?id=<?= $userId ?>" class="btn btn-warning">Update</a>
                                        <a href="../stories/delete.php?id=<?= $userId ?>" class="btn btn-warning">Delete</a>
                                    </td>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>