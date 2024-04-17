<?php 

$selectPro = "SELECT P.ProID, P.ProName, P.ProDescription, P.ProShortDescript, P.ProImage, P.Quantity, P.Price, C.CatName, S.SupName
			 FROM product P, category C, supplier S
			 WHERE P.CatID = C.CatID and P.SupID = S.SupID
			 ORDER BY P.ProID";
			
	$result3 = $conn->query($selectPro);
		if(!$result3){
			die($conn->error);
		}

$selectCat = "SELECT * FROM category";
	$result4 = $conn->query($selectCat);
		if(!$result4){
			die($conn->error);
		}

$selectSup = "SELECT * FROM supplier";
	$result5 = $conn->query($selectSup);
		if(!$result5){
			die($conn->error);
		}

if(isset($_GET["EditID"])){
	$editID = $_GET["EditID"];
    $queryPro ="SELECT P.ProID, P.ProName, P.ProDescription, P.ProShortDescript, P.ProImage, P.Quantity, P.Price, C.CatName, S.SupName
			 	 FROM product P, category C, supplier S
			 	 WHERE ProID=$editID and P.CatID = C.CatID and P.SupID = S.SupID";
		$resultPro =$conn->query($queryPro);
			if(!$resultPro){
				die($conn->error);
			}
}

if(isset($_GET["DelID"])){
	$delID = $_GET["DelID"];
    $queryPro2 ="SELECT P.ProID, P.ProName, P.ProDescription, P.ProShortDescript, P.ProImage, P.Quantity, P.Price, 	C.CatName, S.SupName
			 	 FROM product P, category C, supplier S
			 	 WHERE ProID=$delID and P.CatID = C.CatID and P.SupID = S.SupID";
		$resultPro2 =$conn->query($queryPro2);
			if(!$resultPro2){
				die($conn->error);
			}
}


?>