<?php

session_start();

require_once "../utils/crud.php";

$id = $_GET["id"];

# This is a script that handles the viewing of a user's details.
#
# Use the following crud commands:
#
# $crud = new CRUD();
#
# $result = $crud->selectUsers("id = $id"); 
#
# if (!empty($result)) {
#
#   $user = $result[0];
#   $imageSrc = "../images/users/{$user['image']}";
#   etc.


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php include '../components/navbar.php'; ?>
    <!-- Add layout -->
</body>

</html>