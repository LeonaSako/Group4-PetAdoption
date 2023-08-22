<?php
require_once "../utils/crudStories.php";
require_once "../utils/formUtils.php";

session_start();

$id = $_GET["id"];

$crud = new CRUD_STORY();

$getMsg = $crud->selectMessages("id = $id");
$msg = $getMsg[0];
$status = ($msg['readmsg'] == 0) ? 1 : 0;

$markread = $crud->changeMsgStatus($id, $status);

if ($markread) {
    header("refresh: 1; url = ../agency/seeMessages.php");
}
