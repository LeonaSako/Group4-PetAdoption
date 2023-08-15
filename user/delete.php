<?php
require_once "../utils/crud.php";
require_once "../utils/formUtils.php";

session_start();
preventUser();
preventAgency();

$id = $_GET["id"];

$crud = new CRUD();

$getUser = $crud->selectUsers("id = $id");

removeOldImage("users/" + $getUser[0]["image"]);

$delete = $crud->deleteUser($id);

if ($delete) {
    header("refresh: 3; url = ../admin/dashboard.php");
}
