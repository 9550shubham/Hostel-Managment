<?php
function check_login()
{
if(strlen($_SESSION['id'])==0)
	{	
		$host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra="index.php";		
		$_SESSION["id"]="";
		header("Location: http://$host$uri/$extra");
	}
}


$session_id = filter_var($_SESSION['id'], FILTER_VALIDATE_INT);
if (!$session_id) {
	echo "Invalid session id.";
	exit;
}

?>



									