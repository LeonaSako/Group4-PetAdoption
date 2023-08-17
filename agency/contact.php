<?php

session_start();

require_once "../utils/crud.php";

$crud = new Crud();
$layout = "";

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
    <title>Contact Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #fce4ec;
        }
        .container {
            background-color: #fff;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        .btn-primary {
            background-color: #ff80ab;
            border: none;
        }
        .btn-primary:hover {
            background-color: #ff6090;
        }
        .form-group label {
            color: #ff80ab;
        }
    </style>
</head>
<body>
<?php include '../components/navbar.php'; ?>
    <a class="m-3 btn btn-primary" href="javascript:history.back()">GO BACK</a>
    <div class="container mt-5">
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
            <button type="submit" class="btn btn-primary" name="submit">Send</button>
        </form>
    </div>
   
</body>
</html>
