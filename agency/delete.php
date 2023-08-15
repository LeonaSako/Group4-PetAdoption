<?php
require_once "../utils/crud.php";
require_once "../utils/formUtils.php";

session_start();
preventUser();
preventAgency();

$id = $_GET["id"];

$crud = new CRUD();

$getAgency = $crud->selectUsers("id = $id");

$delete = $crud->deleteAgency($id);

if ($delete) {
    header("refresh: 3; url = ../admin/dashboard.php");
}
