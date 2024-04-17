<?php 
// Get random product
	
	// Random mobile 1
	$selectranm = "SELECT P.ProName, P.ProImage, P.Price, P.ProID
				  FROM product P, category C
				  WHERE P.CatID = C.CatID and C.CatName LIKE 'Điện Thoại'
				  ORDER BY RAND() 
				  LIMIT 4";
	$resultranm = $conn->query($selectranm);
		if(!$resultranm){
			die($conn->error);
		}
		// Random mobile 2
	$selecranm2 = "SELECT P.ProName, P.ProImage, P.Price, P.ProID
				  FROM product P, category C
				  WHERE P.CatID = C.CatID and C.CatName LIKE 'Điện Thoại'
				  ORDER BY RAND() 
				  LIMIT 4";
	$resultranm2 = $conn->query($selecranm2);
		if(!$resultranm2){
			die($conn->error);
		}
		// Random mobile 3
	$selecranm3 = "SELECT P.ProName, P.ProImage, P.Price, P.ProID
				  FROM product P, category C
				  WHERE P.CatID = C.CatID and C.CatName LIKE 'Điện Thoại'
				  ORDER BY RAND() 
				  LIMIT 4";
	$resultranm3 = $conn->query($selecranm3);
		if(!$resultranm3){
			die($conn->error);
		}

	
	// Random laptop 1
	$selecranl = "SELECT P.ProName, P.ProImage, P.Price, P.ProID
				  FROM product P, category C
				  WHERE P.CatID = C.CatID and C.CatName LIKE 'Laptop'
				  ORDER BY RAND() 
				  LIMIT 4";
	$resultranl = $conn->query($selecranl);
		if(!$resultranl){
			die($conn->error);
		}
		// Random laptop 2
	$selecranl2 = "SELECT P.ProName, P.ProImage, P.Price, P.ProID
				  FROM product P, category C
				  WHERE P.CatID = C.CatID and C.CatName LIKE 'Laptop'
				  ORDER BY RAND() 
				  LIMIT 4";
	$resultranl2 = $conn->query($selecranl2);
		if(!$resultranl2){
			die($conn->error);
		}
		// Random laptop 3
	$selecranl3 = "SELECT P.ProName, P.ProImage, P.Price, P.ProID
				  FROM product P, category C
				  WHERE P.CatID = C.CatID and C.CatName LIKE 'Laptop'
				  ORDER BY RAND() 
				  LIMIT 4";
	$resultranl3 = $conn->query($selecranl3);
		if(!$resultranl3){
			die($conn->error);
		}

	// Random Tablet 1
	$selecrant = "SELECT P.ProName, P.ProImage, P.Price, P.ProID
				  FROM product P, category C
				  WHERE P.CatID = C.CatID and C.CatName LIKE 'Máy tính bảng'
				  ORDER BY RAND() 
				  LIMIT 4";
	$resultrant = $conn->query($selecrant);
		if(!$resultrant){
			die($conn->error);
		}
		// Random Tablet 2
	$selecrant2 = "SELECT P.ProName, P.ProImage, P.Price, P.ProID
				  FROM product P, category C
				  WHERE P.CatID = C.CatID and C.CatName LIKE 'Máy tính bảng'
				  ORDER BY RAND() 
				  LIMIT 4";
	$resultrant2 = $conn->query($selecrant2);
		if(!$resultrant2){
			die($conn->error);
		}
		// Random Tablet  3
	$selecrant3 = "SELECT P.ProName, P.ProImage, P.Price, P.ProID
				  FROM product P, category C
				  WHERE P.CatID = C.CatID and C.CatName LIKE 'Máy tính bảng'
				  ORDER BY RAND() 
				  LIMIT 4";
	$resultrant3 = $conn->query($selecrant3);
		if(!$resultrant3){
			die($conn->error);
		}

?>