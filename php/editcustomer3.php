<?php 

if(isset($_GET["CustOD"])){
	$custodid = $_GET["CustOD"];
$custorder = "SELECT p.ProName , p.ProImage, od.Quantity ,od.Price
			  FROM product p, orders o, ordersdetail od, customer c
			  WHERE c.CustID = $custodid AND c.CustID = o.CustID AND P.ProID = od.ProID";
$resultcusorder = $conn->query($custorder);
		if(!$resultcusorder){
			die($conn->error);
		}
}
?>