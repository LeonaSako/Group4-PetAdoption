<?php
$type = $_GET["type"];

if ($type == 'User') {
    include '../components/userForm.php';
} else {
    include '../components/agencyForm.php';
}
