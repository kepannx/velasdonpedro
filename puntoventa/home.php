<?php
session_start();
if (!isset($_SESSION['datos'])) {
	header('Location: login.html');
}
header('Location: ../punto/index.php');
?>