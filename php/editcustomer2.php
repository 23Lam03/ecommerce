<?php 

if(isset($_GET["CustID"])){
		
		$CustID=$_GET["CustID"];
		
		$queryCust2 ="SELECT * FROM customer WHERE CustID=$CustID";
		$resultCust2 =$conn->query($queryCust2);
			if(!$resultCust2){
				die($conn->error);
			}
	}

?>