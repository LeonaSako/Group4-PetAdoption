<?php
session_start();

require_once "../utils/crud.php";
require_once "../utils/formUtils.php";

 echo $userID = $_SESSION["User"];
$crud = new CRUD();


$result2 = $crud->selectUsers("id = $userID");


$users = $result2[0];