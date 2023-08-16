<?php
require_once "../utils/crud.php";
require_once "../utils/formUtils.php";

session_start();
preventUser();
preventAdmin();

# This is a script that handles the agency's dashboard. Only the agency is allowed here.

# To bring all pets listed by the agency, use $results = $crud->selectPets("fk_users_id = {$_SESSION["Agency"]}");

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