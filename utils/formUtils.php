<?php

function cleanInputs($input)
{
    $data = trim($input);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);

    return  $data;
}
function redirectToLogin()
{
    if (!isset($_SESSION["Adm"])) {
        header("Location: ../user/login.php");
    }
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
        header("Location: ../user/dashboard.php");
    }
}
function preventAgency()
{
    if (isset($_SESSION["Agency"])) {
        header("Location: ../agency/dashboard.php");
    }
}
function removeOldImage($oldImage)
{
    if ($oldImage != "placeholder.jpg") {
<<<<<<< HEAD
        unlink("../picture/$oldImage");
=======
        unlink("../images/pets/$oldImage");
>>>>>>> f4d9254831bab8ce88242928856609c4772e19df
    }
}

function validateName($name)
{
    return preg_match('/^[a-zA-ZäöüÄÖÜß\s]+$/', $name);
}
