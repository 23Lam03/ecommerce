<?php 


	$selectCat = "SELECT * FROM category";
	$result1 = $conn->query($selectCat);
		if(!$result1){
			die($conn->error);
		}

if(isset($_GET["EditID"])){
	$CatID = $_GET["EditID"];
    $queryCat ="SELECT * FROM category WHERE CatID=$CatID";
		$resultCat =$conn->query($queryCat);
			if(!$resultCat){
				die($conn->error);
			}
}

if(isset($_GET["DelID"])){
	$CatID = $_GET["DelID"];
    $queryCat2 ="SELECT * FROM category WHERE CatID=$CatID";
		$resultCat2 =$conn->query($queryCat2);
			if(!$resultCat2){
				die($conn->error);
			}
}

?>