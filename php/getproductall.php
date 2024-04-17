
<?php 
	// Get Product all
	
	$selecPro = "SELECT * FROM product";
	$resultPro = $conn->query($selecPro);
		if(!$resultPro){
			die($conn->error);
		}
	
	//Get product by Category
	
	if(isset($_GET["CatID"])){
		
		$CatID=$_GET["CatID"];
		
		$queryProCat ="SELECT * FROM product WHERE CatID=$CatID";
		$resultProCat =$conn->query($queryProCat);
			if(!$resultProCat){
				die($conn->error);
			}
	}
	
	// Get product by Supplier
	if(isset($_GET["SupID"])){
		
		$SupID=$_GET["SupID"];
		
		$queryProSup ="SELECT * FROM product WHERE SupID=$SupID";
		$resultProSup =$conn->query($queryProSup);
			if(!$resultProSup){
				die($conn->error);
			}
	}
	
		// Get Product Detail
	if(isset($_GET["ProID"])){
		
		$ProID=$_GET["ProID"];
		
		$queryProdetail ="SELECT P.ProID, P.ProName, P.ProDescription, P.ProImage, P.Quantity, P.Price, C.CatName, S.SupName 
						  FROM product P, category C, supplier S 
						  WHERE ProID=$ProID and P.CatID = C.CatID and P.SupID = S.SupID";
		$resultProdetail =$conn->query($queryProdetail);
			if(!$resultProdetail){
				die($conn->error);
			}
	}
	
?>
