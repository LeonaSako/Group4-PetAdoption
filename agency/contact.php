<?php
session_start();

$pageTitle = "Contact";

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    echo "Message would have been sent:\n";
    echo "From: $email\n";
    echo "To: leona.sako@gmail.com\n";
    echo "Subject: Message from contact form by: $name\n";
    echo "Message: $message";
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
    <a class="m-3 btn btn-primary" href="javascript:history.back()">GO BACK</a>
    <div class="container mt-5" id='contact-form'>
        <h2>Contact Us</h2>
        <form method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
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