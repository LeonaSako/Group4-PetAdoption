<?php

session_start();

require_once "../utils/crudUser.php";
require_once "../utils/crudAdoption.php";
require_once "../components/usertable.php";
require_once "../utils/crudPet.php";
require_once "../components/breadcrumb.php";



$pageTitle = "Profile";

$id = $_GET["id"];

$crud = new CRUD_USER();

$result = $crud->selectUsers("id = $id");

if (!empty($result)) {

    $user = $result[0];
    $imageSrc = "../images/users/{$user['image']}";
    $name = $user['firstName'] . ' ' . $user['lastName'];
    $address = $user['address'];
    $birthdate = $user['birthdate'];
    $phone = $user['phone'];
    $email = $user['email'];

    $crudAdoption = new CRUD_ADOPTION();

    $applications = $crudAdoption->selectAdoptions("fk_adoptee_id = $id");
    $applic = viewAdoptions($applications);
}

addBreadcrumb('Home', '../user/dashboard.php');
addBreadcrumb('User', '../user/profile.php?id=' . $_SESSION["User"]);
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
                            <img src="<?php echo $imageSrc; ?>" alt="avatar" class="rounded-circle img-fluid" id="profile-picture">
                            <h5 class="my-3"><?php echo $name; ?></h5>
                            <div class="d-flex justify-content-center mb-2">
                                <button type="button" class="btn btn-primary">Follow</button>
                                <button type="button" class="btn btn-outline-primary ms-1">Message</button>
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
                                    <p class="mb-0">Full Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo $name; ?></p>
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
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Birthdate</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo $birthdate; ?></p>
                                </div>
                            </div>
                            <hr>
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
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>