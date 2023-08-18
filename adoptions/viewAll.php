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
  

    if (!empty($result) && is_array($result[0])) {
        foreach ($result[0] as $row) {

                $list .= "
                <tr>";

            if (isset($_SESSION["Agency"]) ) {
                $list .= "
            <td> {$row['adopId']} </td>";
            }; 

            if (isset($_SESSION["Agency"]) || isset($_SESSION["Adm"])) {
                $list .= "
            <td> {$row['petId']} </td>";
            }; 

            if (isset($_SESSION["Agency"])|| isset($_SESSION["Adm"]) || isset($_SESSION["User"])) {
                $list .= "
                <td> {$row['pname']} </td>";
            }; 
            if (isset($_SESSION["Agency"]) || isset($_SESSION["Adm"]) || isset($_SESSION["User"])) {
                $list .= "
                <td> {$row['species']} </td>";
            }; 
            if (isset($_SESSION["Agency"])|| isset($_SESSION["Adm"]) || isset($_SESSION["User"])) {
                $list .= "
                <td> {$row['adopStatus']} </td>";
            }; 
            if (isset($_SESSION["Agency"]) || isset($_SESSION["Adm"]) || isset($_SESSION["User"])) {
                $list .= "
                <td> {$row['adoptionDate']} </td>";
            }; 
            if (isset($_SESSION["Agency"])|| isset($_SESSION["Adm"])|| isset($_SESSION["User"])) {
                $list .= "
                <td> {$row['submitionDate']} </td>";
            }; 
            if (isset($_SESSION["Adm"])) {
                $list .= "
                <td> {$row['userId']} </td>";
            }; 
            if (isset($_SESSION["Agency"]) || isset($_SESSION["Adm"])) {
                $list .= "
                <td> {$row['firstname']} {$row['lastname']} </td>";
            }; 
            if (isset($_SESSION["Agency"]) || isset($_SESSION["Adm"]) || isset($_SESSION["User"])) {
                $list .= "
                <td> {$row['reason']} </td>";
            }; 
            if (isset($_SESSION["Agency"]) || isset($_SESSION["Adm"]) || isset($_SESSION["User"])) {
                $list .= "
                <td> {$row['donation']} </td>";
            }; 
            if (isset($_SESSION["Agency"]) || isset($_SESSION["Adm"])) {
                $list .= "
                <td>
                    <a href='view.php?id={$id}' class='btn btn-primary'>Show</a>
                    <a href='edit.php?id={$id}' class='btn btn-primary'>Edit</a>
                </td>
                </tr>";
            }
        }    
            
    } else {
        // echo $list;
        $list .= "<tr><td colspan='7'>No records found</td></tr>";
    }

           
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
                    <?php if (isset($_SESSION["Agency"])) { ?>
                        <th>Adoption ID</th>
                    <?php } ?>    
                    <?php if (isset($_SESSION["Agency"]) || isset($_SESSION["Adm"])) { ?>
                        <th>Pet ID</th>
                    <?php } ?>
                    <?php if (isset($_SESSION["Agency"]) || isset($_SESSION["Adm"]) || isset($_SESSION["User"])) { ?>
                        <th>Pet Name</th>
                    <?php } ?>
                    <?php if (isset($_SESSION["Agency"]) || isset($_SESSION["Adm"]) || isset($_SESSION["User"])) { ?>
                        <th>Species</th>
                    <?php } ?>
                    <?php if (isset($_SESSION["Agency"]) || isset($_SESSION["Adm"]) || isset($_SESSION["User"])) { ?>
                        <th>Status</th>
                    <?php } ?>
                    <?php if (isset($_SESSION["Agency"]) || isset($_SESSION["Adm"]) || isset($_SESSION["User"])) { ?>
                        <th>Adoption Date</th>
                    <?php } ?>
                    <?php if (isset($_SESSION["Agency"]) || isset($_SESSION["Adm"]) || isset($_SESSION["User"])) { ?>
                        <th>Submission Date</th>
                    <?php } ?>
                    <?php if (isset($_SESSION["Adm"])) { ?>
                        <th>User ID</th>
                    <?php } ?>
                    <?php if (isset($_SESSION["Agency"]) || isset($_SESSION["Adm"])) { ?>
                        <th>User Name</th>
                    <?php } ?>
                    <?php if (isset($_SESSION["Agency"]) || isset($_SESSION["Adm"]) || isset($_SESSION["User"])) { ?>
                        <th>Reason</th>
                    <?php } ?>
                    <?php if (isset($_SESSION["Agency"]) || isset($_SESSION["Adm"]) || isset($_SESSION["User"])) { ?>
                        <th>Donation</th>
                    <?php } ?>
                    <?php if (isset($_SESSION["Agency"]) || isset($_SESSION["Adm"])) { ?>
                        <th>Details</th>
                    <?php } ?>
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