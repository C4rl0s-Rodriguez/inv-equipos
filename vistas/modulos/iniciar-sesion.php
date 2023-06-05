<?php
    session_start();
	$_SESSION["estado"] = "1";
    $_SESSION["nombre"] = $_POST["txtUser"];
	header("Location: ../../index.php");
?>
	
	