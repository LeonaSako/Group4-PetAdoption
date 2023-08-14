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
    if (isset($_SESSION["admin"])) {
        header("Location: ../dashboard.php");
    }
}
function preventUser()
{
    if (!isset($_SESSION["admin"])) {
        header("Location: ../home.php");
    }
}
function removeOldImage($oldImage)
{
    if ($oldImage != "placeholder.jpg") {
        unlink("../pictures/$oldImage");
    }
}

function validateName($name)
{
    return preg_match('/^[a-zA-ZäöüÄÖÜß\s]+$/', $name);
}
