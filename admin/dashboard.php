<?php
require_once "../utils/crud.php";
require_once "../utils/formUtils.php";

session_start();
preventUser();
preventAgency();

# This is a script that handles the admin's dashboard. Only the admin is allowed here.

# To bring all users (including agencies), use $results = $crud->selectUsers("role != 'Adm'");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <title>Admin dashboard</title>
</head>

<body>
    <?php include '../components/navbar.php'; ?>
    <!-- Add layout -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>