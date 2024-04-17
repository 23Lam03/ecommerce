<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="utf-8">
	<title>Laptop Store Website - Giỏ Hàng</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<!--[if ie]><meta content='IE=8' http-equiv='X-UA-Compatible'/><![endif]-->
	<!-- bootstrap -->
	<!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous"> -->
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">      
	<link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">		
	<link href="themes/css/bootstrappage.css" rel="stylesheet"/>

	<!-- global styles -->
	<link href="themes/css/flexslider.css" rel="stylesheet"/>
	<link href="themes/css/main.css" rel="stylesheet"/>
	<link rel="stylesheet" type="text/css" href="themes/css/font-awesome.min.css">
	<!-- <link rel="stylesheet" type="text/css" href="themes/css/font-awesome.min2.css"> -->
	<link rel="stylesheet" type="text/css" href="themes/css/font-awesome.min3.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
	<!-- scripts -->
	<script src="themes/js/jquery-1.7.2.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>				
	<script src="themes/js/superfish.js"></script>	
	<script src="themes/js/jquery.scrolltotop.js"></script>
		<!--[if lt IE 9]>			
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<script src="themes/js/respond.min.js"></script>
		<![endif]-->
	</head>
	
	
<?php
	session_start();
	require_once("connectDB.php");
	
	include("php/menu.php");

	// Check Cart Null
	
	if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])){
		echo '<script language="javascript">
			 	  alert("Shopping cart is empty, please select a product");
				  window.location="products.php"
			      </script>';
	}
	
		// Get ID Product to Array to select in SQL
	foreach($_SESSION['cart'] as $item=>$value){
		$arrayID[] =$item;
		}
	$str= join(",",$arrayID);
	
	// Delete any product
	if(!empty($_GET['id'])){
		$id = $_GET['id'];
		unset($_SESSION['cart'][$id]);
		echo '<script language="javascript">
			 	  alert("You have deleted 1 product");
				  window.location="cart.php"
			      </script>';
	}
	
	// Delete Cart
	if(isset($_POST['cancel'])){
		unset($_SESSION['cart']);
		echo '<script language="javascript">
			 	  alert("You have deleted your shopping cart");
				  window.location="products.php"
			      </script>';
	}
	
	if(isset($_POST['checkout'])){
		if(!empty($_SESSION['User'])){
			
			$idcust = $_SESSION["id"];
			$idstatus = 1;
			$insertOrder = "INSERT INTO orders(OrderDate, CustID, Status) values(CURDATE(),'{$idcust}','{$idstatus}')";
			$resultorder =$conn->query($insertOrder);
			if(!$resultorder){
				die($conn->error);
			}
			$idBill = mysqli_insert_id($conn);
			
			$sql = "SELECT * FROM product where ProID in ({$str})";

			$result =$conn->query($sql);
			if(!$result){
				die($conn->error);
			}
			
			foreach($result as $item){
			
			$id=$item['ProID'];
			$price =$item['Price'];
			$qty=$_SESSION['cart'][$id];
			$inserOrderdetail = "INSERT INTO ordersdetail(OrderID,ProID,Quantity,Price) values('{$idBill}','{$id}','{$qty}','{$price}')";
			$resultorderdetail =$conn->query($inserOrderdetail);
			if(!$resultorderdetail){
				die($conn->error);
			}
				}
			echo '<script language="javascript">
			 	  alert("Thêm giỏ hàng thành công");
				  window.location="products.php"
			      </script>';
									
		}
		else{
			echo '<script language="javascript">
			 	  alert("Vui lòng đăng nhập để mua hàng");
				  window.location="register.php"
			      </script>';
		}
	}
?>
	
	
	<body>		
		<div id="top-bar" class="container">
			<div class="row">
				<div class="span4">
					<form action="search.php" method="POST" class="search_form">
						<div class="input-group">
							<input type="text" class="search-query form-control input-group" Placeholder="Search text" name="txtsearch">
							<span class="input-group-btn">
								<button class="btn btn-primary rounded-circle btnpro" type="submit" name="btnsearch">
									<span class="fa fa-search"></span>
								</button>
							</span>
							
						</div>
					</form>
				</div>
				<div class="span8">
					<div class="account pull-right">
						<ul class="user-menu">	
						<?php 
							// Check seesion User de hien thi nhung muc can thiet
							if(isset($_SESSION['User'])){
							$user=$_SESSION['User'];
							?>
							<li><?php echo "Hello $user"; ?></li>
							<li><a href="customerinfo.php?Username=<?php echo $user ?>">Account information</a></li>
							<li><a href="logout.php">Logout</a></li>
							<li><a href="cart.php">Cart</a></li>
													
						<?php
							 }
							else{?>
							<li><a href="admin.php">Admin administration page</a></li>
							<li><a href="cart.php">Cart</a></li>
							<li><a href="register.php">Login / Sign up</a></li>	
							<?php } ?>		
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div id="wrapper" class="container">
			<section class="navbar main-menu">
				<div class="navbar-inner main-menu">				
					<a href="index.php" class="logo pull-left"><h4 class="title">HENZOSHOP</h4> </a>
					<nav id="menu" class="pull-right">
						<ul>
							<li><a href="index.php">Home Pagr</a></li>
							<li><a href="products.php">Product</a>
								<ul>
								<!--		Menu Category		-->
									<?php while($Catrow = mysqli_fetch_assoc($resultCat)){ ?>
          						<li> <a href="products.php?CatID=<?php echo $Catrow['CatID']?> "><?php echo $Catrow['CatName'];?> </a></li>
 									<?php } ?>
								</ul>
							</li>
							<!--		Menu Supplier		-->		
							<li><a href="#">Manufacturer</a>					
								<ul>
								
								<?php while($Suprow = mysqli_fetch_assoc($resultSup)){ ?>
          							<li> <a href="products.php?SupID=<?php echo $Suprow['SupID']?> "><?php echo $Suprow['SupName'];?> </a></li>
 								<?php } ?>						
								</ul>
							</li>															
							<li><a href="contact.php">Contact</a></li>
							
						</ul>
					</nav>
				</div>
			</section>				
			<section class="header_text sub">
				<img class="pageBanner" src="themes/images/baner.jpg" alt="New products" >
				<br/>
				<h4><span>Shopping Cart</span></h4>
			</section>
			<section class="main-content">				
				<div class="row">
					<div class="span9">					
						<h4 class="title"><span class="text"><strong>Cart</strong> Your </span></h4>
						<table class="table table-striped">

							<thead>
								<tr>
								<th>Order </th>
								<th>Image</th>
								<th> Product Name </th>
								<th> Quantity </th>
								<th> Price </th>
								<th> Total </th>
								<th> Delete </th>
								</tr>
							</thead>
							<tbody>
							
											<?php
												$sql = "SELECT * FROM product where ProID in ({$str})";

												$result =$conn->query($sql);
								  				if(!$result){
													die($conn->error);
												}
												$dem =0;
												$total =0;

												foreach($result as $item){
													$dem = $dem+1;
													$id=$item['ProID'];
													$name =$item['ProName'];
													$image =$item['ProImage'];
													$price =$item['Price'];
													$qty=$_SESSION['cart'][$id];
													$money =$price * $qty;
													$total =$total + $money;

													echo"<tr>";
														echo"<td>{$dem}</td>";
														echo"<td><img width='50px' height='50px' src='{$image}' ></td>";
														echo"<td>{$name}</td>";
														echo"<td>{$qty}</td>";
														echo"<td>{$price}$</td>";
														echo"<td>{$money}$</td>";
														echo"<td><a href='cart.php?id={$id}'>Delete</a></td>";
													echo"</tr>";
													
													
												}

										  ?>
										  <tr>
										  		<td colspan=5>Total amount</td>
										  		<td colspan=5><?php echo $total ?>$</td>
										  		
										  	</tr>

							</tbody>
							
						</table>
						<form method="post" action="process_payment.php">
        <h4 class="title"><span class="text"><strong>Pay</strong></span></h4>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
		<div class="form-group">
			<label for="phone">Phone:</label>
			<input type="tel" class="form-control" id="phone" name="phone" required>
	
        <div class="form-group">
            <label for="payment_method">Payment methods:</label>
            <select class="form-control" id="payment_method" name="payment_method" required>
                <option value="Cash payment">Cash payment</option>
                <option value="Credit card payment">Credit card payment</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" name="checkout">Pay</button>
    </form>
						</p>
						<hr/>
						
							<form class="buttons center" method="post">
							<button class="btn" type="button"> <a href="products.php"> Continue </a></button>
							<button class="btn" type="submit" name="cancel"> Delete </button>
							<button class="btn btn-inverse" type="submit" name="checkout">Confirm</button>
							</form>	
											
					</div>
					<div class="span3 col">
						<div class="block">	
							<ul class="nav nav-list">
								<li><a href="index.php">Home page</a></li>
								<li><a href="products.php">Product</a></li>
								<li><a href="contact.php">Contact</a></li>
							</ul>
							<br/>
							
						</div>
						
					</div>
				</div>
			</section>	
					
			<section style="background-color: #857474;" id="footer-bar">
				<div class="row">
					<div class="span3">
					<h4>Directional</h4>
			<ul class="nav">
				<li><a href="index.php">HOME PAGE</a></li>  
				<li><a href="contact.php">Contact</a></li>
				<li><a href="cart.php">Cart</a></li>
				<li><a href="register.php">Login</a></li>							
			</ul>					
		</div>
		<div class="span4">
			<h4>My Account</h4>
			<ul class="nav">
				<li><a href="customerinfo.php">My account</a></li>
				<li><a href="customerinfo.php">Order history</a></li>
			</ul>
		</div>
		<div class="span5">
			<p class="logo"><!-- <img src="themes/images/logo.png" class="site_logo" alt=""> --><h4>HENZOSHOP</h4></p>
			<p style="color: white;">Our store specializes in providing the newest and most reputable quality products on the market today
				<br/>Visit our store page and don't miss out on new products!</p>
							<div style="margin-left: 60px;">
								<a href="#" class="button">
									<i class="fab fa-facebook-f fa-lg"></i>
								</a>
								<a href="#" class="button">
									<i class="fab fa-twitter fa-lg"></i>
								</a>
								<a href="#" class="button">
									<i class="fab fa-instagram fa-lg"></i>
								</a>
							</div>
							
						</div>					
					</div>	
				</section>
				<section id="copyright">
					<span>Henzo</span>
				</section>
			
			</div>
			<script src="themes/js/common.js"></script>
			<script>
    $(document).ready(function() {
        // Function to capture values and add them to the form submission
        $('#checkout').click(function (e) {
            // Get values
            var productName = $('#product_name').text();
            var quantity = $('#quantity').text();
            var pricePerUnit = $('#price_per_unit').text();

            // Add values to hidden input fields
            $('#product_name_input').val(productName);
            $('#quantity_input').val(quantity);
            $('#price_per_unit_input').val(pricePerUnit);

            // Submit the form
            $('form').submit();
        })
    });
</script>		
		</body>
		</html>