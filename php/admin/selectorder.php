<?php 

$selectorder = "SELECT O.OrderID, C.CustName, C.CustAddress, C.CustPhone, O.OrderDate 
				FROM product P, customer C, orders O, ordersdetail OD
				WHERE P.ProID = OD.ProID and C.CustID = O.CustID";
$resultorder = $conn->query($selectorder);
		if(!$resultorder){
			die($conn->error);
		}

?>