<?php
require_once "../utils/crud.php";
require_once "../utils/formUtils.php";

session_start();
preventUser();

$id = $_GET["id"];

$crud = new CRUD();

$getAnimal = $crud->selectPets("id = $id");

removeOldImage("pets/" + $getAnimal[0]["image"]);

$delete = $crud->deletePet($id);

if ($delete) {
    if (isset($_SESSION["Adm"])) {
        header("refresh: 3; url = ../admin/dashboard.php");
    } else {
        header("refresh: 3; url = ../agency/dashboard.php");
    }
}
