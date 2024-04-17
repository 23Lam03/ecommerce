

<?php 		
	// Get Category
	
	$selecCat = "SELECT * FROM category";
	$resultCat = $conn->query($selecCat);
		if(!$resultCat){
			die($conn->error);
		}
	
	// Get Supplier
	
	$selecSup = "SELECT * FROM supplier";
	$resultSup = $conn->query($selecSup);
		if(!$resultSup){
			die($conn->error);
		}	
  ?>
