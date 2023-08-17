<?php
require_once "../utils/crud.php";
require_once "../utils/formUtils.php";

session_start();
preventUser();
preventAgency();

$id = $_GET["id"];

$crud = new CRUD();

$getUser = $crud->selectUsers("id = $id");

removeOldImage($getUser[0]["image"]);
 $crud->deleteUser($id);


