<?php
session_start();

require_once "../utils/crudStories.php";
require_once "../utils/crudUser.php";
require_once "../messages/viewMessages.php";

$crud = new CRUD_STORY();

$pageTitle = "Messages";

$agency = $_SESSION['Agency'];

$unreadMessages = $crud->selectMessages("fk_agency_id = $agency AND readmsg = 0");
$readMessages = $crud->selectMessages("fk_agency_id = $agency AND readmsg = 1");

$unread = viewMessages($unreadMessages);
$read = viewMessages($readMessages);


?>

<!DOCTYPE html>
<html>

<head>
    <?php include '../components/head.php'; ?>
    <link rel="stylesheet" href="../css/main.css">
    <title><?= $pageTitle ?></title>
</head>

<body>
    <?php include '../components/navbar.php'; ?>

    <div class="container mt-4">
        <h2 class="h2-header">Messages</h2>
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Unread messages
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <?= $unread ?>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Read messages
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <?= $read ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>