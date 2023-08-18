<?php
session_start();

require_once "../utils/crud.php";
require_once "../utils/formUtils.php";
$userID = $_SESSION["User"];
$crud = new CRUD();
$result2 = $crud->selectUsers("id = $userID");
$users = $result2[0];
#$values = [$petID, $userID, $submitionDate, $donation, $reason, $adoptionDate];
#$crud->createStory($values);
public function selectUsers(string $condition)
{
    return $this->select("users", "*", $condition);
}

?>