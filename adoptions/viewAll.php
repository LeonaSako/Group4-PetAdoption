<?php

session_start();

require_once "../utils/crud.php";
require_once "../pet/viewAll.php"; 


function viewAdoptions($result)
{

    if ($_SESSION["Agency"]) {
        $agencyId = $_SESSION["Agency"];
        $result = $crud->selectPets("`fk_users_id` = $agencyId") ;
    } elseif ($_SESSION["User"]) {
        $agencyId = $_SESSION["User"];
        $result = $crud->selectPets("`fk_users_id` = $agencyId"); 
    } elseif ($_SESSION["User"]) {
        $agencyId = $_SESSION["User"];
        $result = $crud->selectPets("`fk_users_id` = $agencyId"); 
    };

    $layout = "";

    if (!empty($result)) {

        # Add the layout here

    } else {
        $layout .= "No results";
    }
    return $layout;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adoption List</title>

</head>
<body>
    <h1>Adoption Registry</h1>
    <table border="1">
        <tr>
            <th>Animal ID</th>
            <th>Name</th>
            <th>Species</th>
            <th>Adoption Date</th>
            <th>Submission Date</th>
            <th>Status</th>
            <th>User ID</th>
            <th>Notes</th>
        </tr>