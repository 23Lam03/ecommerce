<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>New Customer</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<!--[if ie]><meta content='IE=8' http-equiv='X-UA-Compatible'/><![endif]-->
	<!-- bootstrap -->
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">      
	<link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">		
	<link href="themes/css/bootstrappage.css" rel="stylesheet"/>
	<link rel="stylesheet" type="text/css" href="themes/css/font-awesome.min.css">
	<!-- <link rel="stylesheet" type="text/css" href="themes/css/font-awesome.min2.css"> -->
	<link rel="stylesheet" type="text/css" href="themes/css/font-awesome.min3.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
	<!-- global styles -->
	<link href="themes/css/flexslider.css" rel="stylesheet"/>
	<link href="themes/css/main.css" rel="stylesheet"/>

	<!-- scripts -->
	<script src="themes/js/jquery-1.7.2.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>				
	<script src="themes/js/superfish.js"></script>	
	<script src="themes/js/jquery.scrolltotop.js"></script>
		<!--[if lt IE 9]>			
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<script src="js/respond.min.js"></script>
		<![endif]-->
	</head>
	
	
	<!--  Cac doan code php -->
 
  <?php 
	
	require_once("connectDB.php");
	
	// Menu 
	
	include("php/menu.php");
	
	// Get Customer Infor
	include("php/editcustomer.php");
	include("php/editcustomer2.php");
	include("php/editcustomer3.php");
		
		
	// Update Customer Information
	if (isset($_POST["btnupdate"])){
		$password= $_POST['txtpassword'];
		$name= $_POST['txtname'];
		$gender = $_POST['rdgender'];
		$dob= $_POST['txtdob'];
		$address= $_POST['txtaddress'];	
		$phone= $_POST['txtphone'];
		$email= $_POST['txtemail'];
		$id = $_POST['txtid'];
		$strUpdate= "UPDATE customer
		SET Password ='$password',CustName ='$name',CustGender ='$gender', CustDOB = '$dob',CustAddress = '$address',CustPhone = '$phone',CustEmail = '$email' 
		WHERE CustID = $id";

		$updateCus =$conn->query($strUpdate);
		echo '<script language="javascript">
			alert("You have successfully updated your information");
			window.location="index.php";
			</script>';
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
							// Check seesion User to display Personal Information
							session_start();
							if(isset($_SESSION['User'])){
							$user=$_SESSION['User'];
													?>
							<li><?php echo "Xin chào bạn $user"; ?></li>
							<li><a href="customerinfo.php?Username=<?php echo $user; ?>">Account information</a></li>
							<li><a href="logout.php">Logout</a></li>
							<li><a href="cart.php">Cart</a></li>
												
						<?php
							 }
							else{
								echo '<script language="javascript">
			 	  		 			  alert("please login");
				  		              window.location="register.php";
						 </script>';
							}?>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div id="wrapper" class="container">
			<section class="navbar main-menu">
				<div class="navbar-inner main-menu">				
					<a href="index.php" class="logo pull-left"><h4 class="title">HENZOSHOP </h4></a>
					<nav id="menu" class="pull-right">
						<ul>
							<li><a href="index.php">Home page</a></li>
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
							<li><a href="contact.php">Liên hệ</a></li>
							
						</ul>
						</nav>
					</div>
				</section>
				<section  class="homepage-slider" id="home-slider">
					<div class="flexslider">
						<ul class="slides">
							<li>
								<img src="themes/images/carousel/slider_1.jpg" alt="anh bia 1" />
								<div class="intro">
							<!--<h1>Laptop mua online</h1>
							<p><span>Giảm thêm đến 1.000.000đ</span></p>
							<p><span>Áp dụng kèm theo khuyến mãi trả thẳng khác</span></p> -->
						</div>
					</li>
					<li>
						<img src="themes/images/carousel/slider_4.png" alt="anh bia 2" />
						
					</li>
					<li>
						<img src="themes/images/carousel/slider_5.png" alt="anh bia 3" />
						
					</li>
					<li>
						<img src="themes/images/carousel/slider_6.png" alt="anh bia 4" />
						
					</li>
					<li>
						<img src="themes/images/carousel/slider_7.png" alt="anh bia 5" />
						
					</li>
				</ul>
			</div>			
		</section>
		<section class="header_text">
		Our website specializes in providing reputable and newest quality products on the market today
		<br/>Visit our website and don't miss out on new products!

		</section>			
		<br/>
		<br/>				
				<div class="row">
					<div class="span5">	
						<?php 
									if(isset($_GET["Username"])){
									$userrow = mysqli_fetch_assoc($resultCus)?>
						<h4 class="title"><span class="text"><strong>Account information</strong></span></h4>
							<fieldset>
								<div>
									
								<label> <strong>Full name</strong> </label>
								<label class="control-label"><?php echo $userrow['CustName'];?> </label>
								<label> <strong>Gender</strong> </label>
								<label class="control-label"><?php echo $userrow['CustGender'];?> </label>
								<label> <strong>Date of birth</strong> </label>
								<label class="control-label"><?php echo $userrow['CustDOB'];?> </label>
								<label> <strong>Address</strong> </label>
								<label class="control-label"><?php echo $userrow['CustAddress'];?> </label>
								<label> <strong>Phone</strong> </label>
								<label class="control-label"><?php echo $userrow['CustPhone'];?> </label>
								<label> <strong>Email</strong> </label>
								<label class="control-label"><?php echo $userrow['CustEmail'];?> </label>
								<label> <a href="customerinfo.php?CustID=<?php echo $userrow['CustID']; ?>">Edit info</a></label>
								<label> <a href="customerinfo.php?CustOD=<?php echo $userrow['CustID']; ?>">Your Order</a></label>
								<?php } ?>
										
								</div>
							</fieldset>			
					</div>
					<div class="span7">		
						
						<?php if(isset($_GET["CustID"])){
								$userrow2 = mysqli_fetch_assoc($resultCust2);?>
						<h4 class="title"><span class="text"><strong>Update personal information</strong></span></h4>			
						<form action="customerinfo.php" method="post" class="form-stacked" name="formupdate">
							<fieldset>
							    <div class="control-group">
									<label class="control-label">First and last name</label>
									<div class="controls">
										<input type="text" value="<?php echo $userrow2['CustName'];?>"   class="input-xlarge"  name="txtname">
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label">Sex</label>
									<div class="controls">
										<input type="radio" name="rdgender" value="Male" <?php if($userrow2['CustGender'] == 'Male' ){ ?> checked = "checked" <?php } ?> /> &nbsp; Male &nbsp;
										<input type="radio" name="rdgender" value = "Female" <?php if($userrow2['CustGender'] == 'Female' ){ ?> checked = "checked" <?php } ?>/> &nbsp; Female
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label">Date of birth</label>
									<div class="controls">
										<input type="date" class="input-xlarge" value="<?php echo $userrow2['CustDOB'];?>"  name="txtdob">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Address</label>
									<div class="controls">
										<input type="text" value="<?php echo $userrow2['CustAddress'];?>"  class="input-xlarge"  name="txtaddress">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Email</label>
									<div class="controls">
										<input type="text" value="<?php echo $userrow2['CustEmail'];?>" class="input-xlarge" name="txtemail">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Phone number</label>
									<div class="controls">
										<input type="text" value="<?php echo $userrow2['CustPhone'];?>" class="input-xlarge" name="txtphone">
										<input type="hidden" value="<?php echo $userrow2['CustID'];?>" class="input-xlarge" name="txtid">
									</div>
						</div>							                            
								<hr>
								<div class="actions"><input tabindex="9" class="btn btn-primary large"  type="submit" name= "btnupdate" value="Update"></div>
							</fieldset>
							
						</form>	
						<?php } ?> 	
						
						
						
						
						<div class="span5">
						
						<?php
							// Display Customer Ordered
						if(isset($_GET["CustOD"])){ ?>
						<h4 class="title"><span class="text"><strong>Placed order information</strong></span></h4>
						
						<?php  			
									while($userrow3 = mysqli_fetch_assoc($resultcusorder)){;?>
							<table class="table table-striped">
							<thead>
								<tr>	
								<th> Product Name </th>
								<th>Image</th>
								<th> Quantity </th>
								<th> Price </th>
									
								</tr>
							</thead>	
							<tbody>	   
								<tr>
									<td><?php echo $userrow3['ProName']; ?></td>
									<td><img width="70px" height='70px' src="<?php echo $userrow3['ProImage']?>" ></td>
									<td><?php echo $userrow3['Quantity'];?></td>
									<td><?php echo $userrow3['Price'];?>$</td>							
								</tr>								
							</tbody>
						</table>				
						<?php } 
						}
							?>
						
						</div>
						
									
					</div>				
				</div>
	</section>						
	<section style="background-color: #857474;" id="footer-bar">
		<div class="row">
			<div class="span3">
				<h4>Điều Hướng</h4>
				<ul class="nav">
				<li><a href="index.php">Home</a></li>
				<li><a href="./about.html">Information</a></li>
				<li><a href="contact.php">Contact</a></li>
				<li><a href="cart.php">Cart</a></li>
				<li><a href="register.php">Sign in</a></li>						
				</ul>					
			</div>
			<div class="span4">
				<h4>My Account</h4>
				<ul class="nav">
				<li><a href="customerinfo.php">My Account</a></li>
				<li><a href="#">Order history</a></li>
				<li><a href="#">Favorite List</a></li>
				<!-- <li><a href="#">Refresh</a></li> -->
				</ul>
			</div>
			<div class="span5">
				<p class="logo"><!-- <img src="themes/images/logo.png" class="site_logo" alt=""> --><h4>HENZOSHOP</h4></p>
				<p style="color: white;">Our website specializes in providing the newest and most reputable quality products on the market today.
				<br/>Visit our website and don't miss out on new products!</p>
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
	<script type="text/javascript" src="themes/js/common.js"></script>
	<script src="themes/js/jquery.flexslider-min.js"></script>
	<script type="text/javascript">
		$(function() {
			$(document).ready(function() {
				$('.flexslider').flexslider({
					animation: "fade",
					slideshowSpeed: 4000,
					animationSpeed: 600,
					controlNav: false,
					directionNav: true,
						controlsContainer: ".flex-container" // the container that holds the flexslider
					});
			});
		});
		$(document).ready(function() {
			$('#checkout').click(function (e) {
				document.location.href = "checkout.html";
			})
		});
	</script>
	
	</body>
	</html>	