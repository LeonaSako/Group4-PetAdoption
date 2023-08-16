<?php
session_start();

if (isset($_GET['logout'])) {
   unset($_SESSION['Adm']);
   session_unset();
   session_destroy();
   header("Location: login.php");
}