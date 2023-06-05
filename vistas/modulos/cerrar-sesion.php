<?php 
	session_start(); //SE DEBE USAR CADA VEZ QUE SE USAN LAS VARIABLES DE SESION
	$_SESSION = array(); //Restableciendo las variables de sesion

	if (ini_get("session.use_cookies")) { //Eliminando las cookies
		$params = session_get_cookie_params();
		setcookie(session_name(), '', time() - 42000,
			$params["path"], $params["domain"],
			$params["secure"], $params["httponly"]
		);
	}
	
	session_destroy(); //Destroy no eliminar los valores de las variables y la cookies
	header("Location: ../../index.php");
?>
	
	