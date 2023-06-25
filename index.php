<?php
session_start();
$_SESSION['login'] = "vide";
$_SESSION['id'] = "-1";
$_SESSION['type'] = "-1";
header('Location: ./router/router.php?action=accueilDoctolib');
 ?>
