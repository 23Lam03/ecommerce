<!DOCTYPE html>
<html lang="vi">
	<head>
		<meta charset="utf-8">
		<title>Laptop Store Website - Giỏ Hàng</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<!--[if ie]><meta content='IE=8' http-equiv='X-UA-Compatible'/><![endif]-->
		<!-- bootstrap -->
		<link rel="stylesheet" href="bootstrap/css/font-awesome.min.css">
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
   
   
   <?php 
	
	require_once("connectDB.php");
	
	// Menu 
	
	include("php/menu.php");
	
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
							<li><?php echo "Hello $user"; ?></li>
							<li><a href="customerinfo.php?Username=<?php echo $user ?>">Account information</a></li>
							<li><a href="logout.php">Logout</a></li>
							<li><a href="cart.php">Cart</a></li>						
						<?php
							 }
							else{?>
							<li><a href="admin.php">Admin administration page</a></li>
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
					<a href="index.php" class="logo pull-left"><h4 class="title">HENZOSHOP</h4></a>
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
							<li><a href="contact.php">Contact</a></li>
							
						</ul>
					</nav>
				</div>
			</section>								
			
			<section class="header_text sub">
			<img class="pageBanner" src="themes/images/carousel/slider_4.png" alt="New products" >
				<h4><span>Contact us</span></h4>
			</section>
			<section class="main-content">				
				<div class="row">				
					<div class="span5">
						<div>
							<h5>Contact Info</h5>
							<p>
							<strong>Address:</strong>&nbsp;177/10 Trung My Tay Q12 <br>	
							<strong>Phone:</strong>&nbsp;0373264180<br>
							<strong>Email:</strong>&nbsp;<a href="#">leduclam2303@gmail.com</a>								
							</p>
							<br/>
						</div>
					</div>
					<div class="span7">
						<p>Leave a message to help us serve you better</p>
						<form method="post" action="#">
							<fieldset>
								<div class="clearfix">
									<label for="name"><span>Name:</span></label>
									<div class="input">
										<input tabindex="1" size="18" id="name" name="name" type="text" value="" class="input-xlarge" placeholder="Name">
									</div>
								</div>
								
								<div class="clearfix">
									<label for="email"><span>Email:</span></label>
									<div class="input">
										<input tabindex="2" size="25" id="email" name="email" type="text" value="" class="input-xlarge" placeholder="Email address">
									</div>
								</div>
								
								<div class="clearfix">
									<label for="message"><span>Message:</span></label>
									<div class="input">
										<textarea tabindex="3" class="input-xlarge" id="message" name="body" rows="7" placeholder="Write something..."></textarea>
									</div>
								</div>
								
								<div class="actions">
									<button tabindex="3" type="submit" class="btn btn-primary">Send Message</button>
								</div>
							</fieldset>
						</form>
					</div>				
				</div>
			</section>		
			<section class="google_map">
				<iframe src="https://www.google.com/maps/embed?pb=!1m13!1m8!1m3!1d489.79868535961987!2d106.6153841!3d10.8579521!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMTDCsDUxJzI5LjIiTiAxMDbCsDM2JzU1LjEiRQ!5e0!3m2!1svi!2s!4v1710426410285!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
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
		<span>HENZOSHOP</span>
	</section>
		</div>
		<script src="themes/js/common.js"></script>
    </body>
</html>