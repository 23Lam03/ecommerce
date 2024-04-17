<?php 

	$selectuser = "SELECT * FROM customer";
	$resultuser = $conn->query($selectuser);
		if(!$resultuser){
			die($conn->error);
		}

	if(isset($_GET["Username"])){
		
		$name=$_GET["Username"];
		
		$queryCus ="SELECT * FROM customer WHERE Username='$name'"; // Bien $name la chuoi
		$resultCus =$conn->query($queryCus);
			if(!$resultCus){
				die($conn->error);
			}
	}
	
?>