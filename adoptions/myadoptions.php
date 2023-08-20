<?php
session_start();

require_once "../utils/crudAdoption.php";
require_once "../utils/crudUser.php";
require_once "../utils/crudPet.php";
require_once "../components/usertable.php";
require_once "../utils/formUtils.php";
require_once "../components/breadcrumb.php";

$id = $_SESSION["User"];

$pageTitle = "My adoptions";

preventAgency();
preventAdmin();

$crud = new CRUD_ADOPTION();

$applications = $crud->selectAdoptions("fk_adoptee_id = $id");
$applic = viewAdoptions($applications);

addBreadcrumb('Home', '../user/dashboard.php');
addBreadcrumb('User', '../user/profile.php?id=' . $_SESSION["User"]);
addBreadcrumb('Adoptions');

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>