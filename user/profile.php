<?php

session_start();

require_once "../utils/crudUser.php";
require_once "../utils/crudAdoption.php";
require_once "../utils/crudStories.php";
require_once "../components/usertable.php";
require_once "../utils/crudPet.php";
require_once "../components/breadcrumb.php";

$pageTitle = "Profile";

$adoptionStoriesSection = "hidden";

if (isset($_SESSION["User"])) {
    $id = $_SESSION["User"];
    $adoptionStoriesSection = "";
    addBreadcrumb('Home', '../home.php');
} elseif (isset($_SESSION["Adm"])) {
    $id = $_SESSION["Adm"];
    addBreadcrumb('Dashboard', '../admin/dashboard.php');
} elseif (isset($_SESSION["Agency"])) {
    $id = $_SESSION["Agency"];
    addBreadcrumb('Dashboard', '../agency/dashboard.php');
} else {
    header("Location: ../user/login.php");
}

$crud = new CRUD_USER();

$result = $crud->selectUsers("id = $id");

$url = "../user/update.php";

if (!empty($result)) {

    $user = $result[0];

    $imageSrc = "../images/users/{$user['image']}";
    $name = $user['firstName'] . ' ' . $user['lastName'];
    $address = $user['address'];

    $birthdate = $user['birthdate'];
    $dateTime = new DateTime($birthdate);
    $birthdate = $dateTime->format("d/m/Y");

    $phone = $user['phone'];
    $email = $user['email'];
    $agency = $user['agency'];

    $crudAdoption = new CRUD_ADOPTION();

    $applications = $crudAdoption->selectAdoptions("fk_adoptee_id = $id");

    $applic = viewAdoptions($applications);
}

$crud = new CRUD_STORY();

if (isset($_SESSION['User'])) {

    $stories = $crud->selectStories("fk_user_id = $id");

    if (!empty($stories)) {
        foreach ($stories as $story) {

            $image = "../images/stories/{$story['image']}";
            $desc = $story["desc"];

            $dateString = $story["date"];
            $dateTime = new DateTime($dateString);
            $formattedDate = $dateTime->format("d/m/Y");

            $userId = $story["id"];
        }
    } else {
        $adoptionStoriesSection = "hidden";
    }
}


addBreadcrumb('Profile');

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
                            <img src="<?= $imageSrc ?>" alt="avatar" class="rounded-circle img-fluid" id="profile-picture">
                            <h5 class="my-3"><?= $name ?></h5>
                            <div class="d-flex justify-content-center mb-2">
                                <a href="<?= $url ?>" class="btn btn-primary">Update</a>
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
                                    <p class="text-muted mb-0"><?= $name; ?></p>
                                <?php } ?>
                                <?php if (isset($_SESSION['Agency'])) { ?>
                                    <p class="mb-0">Agency Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?= $agency; ?></p>
                                <?php } ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?= $email; ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Phone</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?= $phone; ?></p>
                                </div>
                            </div>
                            <hr>
                            <?php if (isset($_SESSION['User']) || isset($_SESSION['Adm'])) { ?>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Birthdate</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0"><?= $birthdate; ?></p>
                                    </div>
                                </div>
                                <hr>
                            <?php } ?>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Address</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?= $address; ?></p>
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
                                <div class="table-responsive">
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
                </div>
            <?php } ?>
            <div class="row" <?= $adoptionStoriesSection ?>>
                <div class="col">
                    <div class="card mb-4">
                        <div class="card-header">
                            My adoption stories
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">Story</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <td scope="col"><?= $formattedDate ?></td>
                                        <td scope="col">
                                            <p class='fw-light word-wrap'><?= $desc ?></p>
                                        </td>
                                        <td scope="col">
                                            <p class="d-inline-flex gap-1">
                                                <a href="../stories/mystory.php?id=<?= $userId ?>" class="btn btn-warning">Details</a>
                                                <a href="../stories/update.php?id=<?= $userId ?>" class="btn btn-primary">Update</a>
                                        </td>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>