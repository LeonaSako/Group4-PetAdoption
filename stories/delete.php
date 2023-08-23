<?php
require_once "../utils/crudUser.php";
require_once "../utils/crudStories.php";
require_once "../utils/formUtils.php";
session_start();
preventUser();
preventAgency();
$id = $_GET["id"];
$crud = new CRUD_STORY();
$delStory = $crud->deleteStory("id = $id"); 
$crud->deleteStory($id);
header("refresh:2; url = ../user/profile.php?id=" . $_SESSION["User"]);

