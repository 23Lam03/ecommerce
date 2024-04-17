
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Product Detail</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<!--[if ie]><meta content='IE=8' http-equiv='X-UA-Compatible'/><![endif]-->
		
		<!-- bootstrap -->
		<link rel="stylesheet" href="bootstrap/css/font-awesome.min.css">
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">      
		<link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">		
		<link href="themes/css/bootstrappage.css" rel="stylesheet"/>
		
		<!-- global styles -->
		<link rel="stylesheet" type="text/css" href="themes/css/font-awesome.min.css">
		<link href="themes/css/main.css" rel="stylesheet"/>
		<link href="themes/css/jquery.fancybox.css" rel="stylesheet"/>
		<link rel="stylesheet" type="text/css" href="themes/css/font-awesome.min.css">
	<!-- <link rel="stylesheet" type="text/css" href="themes/css/font-awesome.min2.css"> -->
	<link rel="stylesheet" type="text/css" href="themes/css/font-awesome.min3.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
		<!-- scripts -->
		<script src="themes/js/jquery-1.7.2.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>				
		<script src="themes/js/superfish.js"></script>	
		<script src="themes/js/jquery.scrolltotop.js"></script>
		<script src="themes/js/jquery.fancybox.js"></script>
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
	
	// Product All
	include("php/getproductall.php");
	
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
							session_start();
							if(isset($_SESSION['User'])){
							$user=$_SESSION['User'];
							?>
							<li><?php echo "Xin chào bạn $user"; ?></li>
							<li><a href="customerinfo.php?Username=<?php echo $user ?>">Account information</a></li>
							<li><a href="logout.php">Logout</a></li>
							<li><a href="cart.php">Cart</a></li>
													
						<?php
							 }
							else{?>
							<li><a href="admin.php">Admin admin page</a></li>
							<li><a href="cart.php">Cart</a></li>
							<li><a href="register.php">Login / Register</a></li>
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
						<li><a href="index.php">Home</a></li>
						<li><a href="products.php">Products</a>
								<ul>
									<?php while($Catrow = mysqli_fetch_assoc($resultCat)){ ?>
          						<li> <a href="products.php?CatID=<?php echo $Catrow['CatID']?> "><?php echo $Catrow['CatName'];?> </a></li>
 									<?php } ?>	
								</ul>
							</li>																
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
			<img class="pageBanner" src="themes/images/carousel/slider_2.jpg" alt="New products" >
				<h4><span>Product details</span></h4>
			</section>	
			<section class="main-content">				
				<div class="row">
				<?php
				if(isset($_GET["ProID"])){
				$Prodetail = mysqli_fetch_assoc($resultProdetail)?>						
					<div class="span9">
						<div class="row">
							<div class="span4">
								<a href="<?php echo $Prodetail['ProImage']?>" class="thumbnail" data-fancybox-group="group1" title="Description 1"><img alt="" src="<?php echo $Prodetail['ProImage']?>"></a>					
							</div>
							<div class="span5">
								<address>
									<strong>Manufacturer:</strong> <span><?php echo $Prodetail['SupName']?></span><br>
									<strong>Quantity:</strong> <span><?php echo $Prodetail['Quantity']?></span><br>
									<strong>Type:</strong> <span><?php echo $Prodetail['CatName']?></span><br>						
								</address>									
								<h4><strong>Price: <?php echo $Prodetail['Price']?>$</strong></h4>
							</div>
							<div class="span5">
								<form class="form-inline">
									<button class="btn btn-inverse" name="addcart"><a href="addcart.php?ProID=<?php echo $Prodetail['ProID'] ?>">Add to Cart</a></button>
								</form>
							</div>							
						</div>
						<br>
						<div class="row">
							<div class="span9">
								<ul class="nav nav-tabs" id="myTab">
									<li class="active"><a href="#home">Describe</a></li>
								</ul>							 
								<div class="tab-content">
									<div class="tab-pane active" id="home"><?php echo $Prodetail['ProDescription'];?></div>
									<div class="tab-pane" id="profile">

									</div>
								</div>							
							</div>	
							<?php } // end while ?>
						</div>
					</div>
					<div class="span3 col">
						<div class="block">	
							<ul class="nav nav-list">
							<li><a href="index.php">Home</a></li>
							<li><a href="products.php">Products</a></li>
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
						<li><a href="index.php">Home</a></li>
						<li><a href="contact.php">Contact</a></li>
						<li><a href="cart.php">Cart</a></li>
						<li><a href="register.php">Sign in</a></li>						
						</ul>					
					</div>
					<div class="span4">
						<h4>My Account</h4>
						<ul class="nav">
						<li><a href="customerinfo.php">My Account</a></li>
						<li><a href="customerinfo.php">Order history</a></li>
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
		<script src="themes/js/common.js"></script>
		<script>
			$(function () {
				$('#myTab a:first').tab('show');
				$('#myTab a').click(function (e) {
					e.preventDefault();
					$(this).tab('show');
				})
			})
			$(document).ready(function() {
				$('.thumbnail').fancybox({
					openEffect  : 'none',
					closeEffect : 'none'
				});
				
				$('#myCarousel-2').carousel({
                    interval: 2500
                });								
			});
		</script>
    </body>
</html>