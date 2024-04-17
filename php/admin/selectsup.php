<?php 

$selectSup = "SELECT * FROM supplier";
	$result2 = $conn->query($selectSup);
		if(!$result2){
			die($conn->error);
		}

if(isset($_GET["EditID"])){
	$supID = $_GET["EditID"];
    $querySup ="SELECT * FROM supplier WHERE SupID=$supID";
		$resultSup =$conn->query($querySup);
			if(!$resultSup){
				die($conn->error);
			}
}

if(isset($_GET["DelID"])){
	$delID = $_GET["DelID"];
    $querySup2 ="SELECT * FROM supplier WHERE SupID=$delID";
		$resultSup2 =$conn->query($querySup2);
			if(!$resultSup2){
				die($conn->error);
			}
}

?>




