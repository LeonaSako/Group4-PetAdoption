<?php
session_start();

require_once "../utils/crudStories.php";
require_once "../utils/crudUser.php";

$crud = new CRUD_STORY();
$crudUser = new CRUD_USER();

$pageTitle = "Messages";

$agency = $_SESSION['Agency'];

$messages = $crud->selectMessages("fk_agency_id = $agency");


function userName(string $userId,CRUD_USER $crudUser){
    $users = $crudUser->selectUsers("id = $userId LIMIT 1");
    $firstName = "";
    $lastName = "";
    foreach ($users as $user):
    $firstName = $user["firstName"];
    $lastName = $user["lastName"];
    endforeach;

    return $firstName . " " . $lastName;
}

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
        <h1><?= $pageTitle ?></h1>
        <?php foreach ($messages as $message): ?>
            <div class="card mb-3">
                <div class="card-header">
                    Sent By: <?= userName($message['fk_user_id'],$crudUser) ?>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Message</h5>
                    <p class="card-text"><?= $message['message']; ?></p>
                </div>
                <div class="card-footer text-muted">
                    Date: <?= $message['date']; ?>
                </div>

                <div class="card-body">
                    <form method="post">
                        <div class="form-group">
                            <label for="reply">Reply:</label>
                            <textarea class="form-control" id="reply" name="reply" rows="4" required></textarea>
                        </div>
                        <div class="buttons">
                            <button type="submit" class="btn btn-primary" name="submit-reply">Reply</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
