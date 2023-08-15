<?php

function cleanInputs($input)
{
    $data = trim($input);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);

    return  $data;
}
function preventAdmin()
{
    if (isset($_SESSION["Adm"])) {
        header("Location: ../admin/dashboard.php");
    }
}
function preventUser()
{
    if (isset($_SESSION["User"])) {
        header("Location: ../user/dahsboard.php");
    }
}
function preventAgency()
{
    if (isset($_SESSION["Agency"])) {
        header("Location: ../agency/dahsboard.php");
    }
}
function removeOldImage($oldImage)
{
    if ($oldImage != "placeholder.jpg") {
        unlink("../images/$oldImage");
    }
}

function validateName($name)
{
    return preg_match('/^[a-zA-ZäöüÄÖÜß\s]+$/', $name);
}
