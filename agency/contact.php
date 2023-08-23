<?php
session_start();

require_once "../utils/crudStories.php";

$pageTitle = "Contact";

$crud = new CRUD_STORY();

$receiver = $_GET["id"];

if (isset($_SESSION["User"])) {
    $sender = $_SESSION["User"];
    $read_agency = 0;
    $read_user = 1;
} else if (isset($_SESSION["Agency"])) {
    $sender = $_SESSION["Agency"];
    $read_agency = 1;
    $read_user = 0;
}

if (isset($_POST["submit"])) {

    $subject = $_POST["subject"];
    $message = $_POST["message"];

    $values = [$subject, $message, $sender, $receiver, $read_agency, $read_user];

    $crud->createMessage($values);
}

addBreadcrumb('Home', '../home.php');
addBreadcrumb('Messages', '../messages/seeMessages.php');
addBreadcrumb('Contact agency');
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
    <a class="m-3 btn btn-primary" href="javascript:history.back()">GO BACK</a>
    <div class="container mt-5" id='contact-form'>
        <h2>Contact Us</h2>
        <form method="post">
            <div class="form-group">
                <label for="name">Subject:</label>
                <input type="text" class="form-control" id="subject" name="subject" required>
            </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
            </div>
            <div class="buttons">
                <button type="submit" class="btn btn-primary" name="submit">Send</button>
            </div>

        </form>
    </div>

</body>

</html>