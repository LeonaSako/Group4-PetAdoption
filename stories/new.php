<?php
session_start();

require_once "../utils/crud.php";
require_once "../utils/formUtils.php";

$petID = $_GET["id"];
$userID = $_SESSION["User"];
$crud = new CRUD();

$result1 = $crud->selectPets("id = $petID");
$result2 = $crud->selectUsers("id = $userID");

$pets = $result1[0];
$users = $result2[0];
$values = [$petID, $userID, $submitionDate, $donation, $reason, $adoptionDate];
$crud->createStory($values);

?>