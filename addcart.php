<?php
	session_start();
	if(!empty($_GET['ProID']))
	{
		$proid= $_GET['ProID'];
		
		if(isset($_SESSION['cart'][$proid])){
			$qty = $_SESSION['cart'][$proid] + 1;
		}
		else{
			$qty =1;
		}
	}
	else{
		header("location:index.php");
		}
		
	$_SESSION['cart'][$proid] = $qty;
	header("location:cart.php");

?>