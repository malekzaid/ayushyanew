<?php
session_start();
if (!isset($_SESSION['email']) || !isset($_SESSION['role'])) {
    header('Location: login.php');
    exit();
}

if ($_SESSION['role'] == 'admin') {
    require("manage-staff.php");
} elseif ($_SESSION['role'] == 'doctor') {
    require("doctorDash.php");
} elseif ($_SESSION['role'] == 'receptionist') {
    require("receptionist.php");
} else {
    header('Location: login.php');
    exit();
}
?>
