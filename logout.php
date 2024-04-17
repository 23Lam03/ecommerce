
	<?php 
	//Check session Admin
	session_start();
	if(isset($_SESSION['Admin'])){
	$_SESSION[] = array(); 
	unset($_SESSION['Admin']);
	header("Location:index.php");
	}
	//Check session User
	if(isset($_SESSION['User'])){
	$_SESSION[] = array(); 
	unset($_SESSION['User']);
	header("Location:index.php");
	}
	?>
