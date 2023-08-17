<?php

session_start();

require_once "../utils/crud.php";
require_once "../pet/viewAll.php"; 

$crud = new CRUD();

// function viewAdoptions($result) {

    if (isset($_SESSION["Adm"])) {
        $id = $_SESSION["Adm"];
        $result = $crud->selectAdoptions(""); 
        
    } elseif (isset($_SESSION["Agency"])) {
        $id = $_SESSION["Agency"];
        $result = $crud->selectAdoptions("WHERE p.fk_users_id = $id OR p.fk_users_id = NULL "); 
        
    } elseif (isset($_SESSION["User"])) {
        $id = $_SESSION["User"];
        $result = $crud->selectAdoptions("WHERE u.id = $id"); 
    };


    $list = "";
    if (isset($result[0])) {
        foreach ($result[0] as $row) {
        // if (isset($result)) {
        //     foreach ($result as $row) {
                $list .= "
                <tr>
                <td> {$row['adopId']} </td>
                <td> {$row['petId']} </td>

                </tr>";
        }
    } else {
        $list .= "<tr><td colspan='8'>No records found</td></tr>";
    }
    echo $list;


    // $layout .= "No results";

            
                // if (isset($_SESSION["Adm"])) {
                //     echo "<td>" . $row['adoption.adoptionDate'] . "</td>";
                //     echo "<td>" . $row['adoption.submissionDate'] . "</td>";
                //     echo "<td><strong>" . $row['adoption.status'] . "</strong></td>";
                // }
           
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />

    <title>Adoption List</title>

</head>

<body>

    <?php include '../components/navbar.php'; ?>

    <div class="container">
        <h1>Adoption Status List</h1>
        <table class="table table-striped table-hover table-sm">
            <thead>
                <tr>
                    <th>Adoption Nr</th>
                    <th>Pet ID</th>
                    <th>Pet Name</th>
                    <th>Species</th>
                    <th>Status</th>
                    <th>Adoption Date</th>
                    <th>Submission Date</th>
                    <th>User ID</th>
                    <th>User Name</th>
                    <th>Notes</th>
                    <th>Donation</th>
                </tr> 
            </thead>

            <tbody>   
                <?= $list ?>
            </tbody>
        </table>
    </div>
   
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    </body>

</html>