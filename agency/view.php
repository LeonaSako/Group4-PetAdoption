<?php

session_start();

require_once "../utils/crud.php";

$id = $_GET["id"];

# This is a script that handles the viewing of an agency's details.
#
# Use the following crud commands:
#
# $crud = new CRUD();
#
# $result = $crud->selectUsers("id = $id"); 
#
# if (!empty($result)) {
#
#   $agency = $result[0];
#   etc.


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <link rel="stylesheet" href="../style/main.css">
    <title>Agency details</title>
</head>

<body>
    <?php include '../components/navbar.php'; ?>
    <div class="container">
        <div class="row justify-content-center">
            <?= $layout ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>