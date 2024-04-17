<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Products</title>
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
	<link rel="stylesheet" type="text/css" href="themes/css/jquery-ui.min.css">
	<!-- scripts -->
	<script src="themes/js/jquery-1.7.2.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>				
	<script src="themes/js/superfish.js"></script>	
	<script src="themes/js/jquery.scrolltotop.js"></script>
	<script type="text/javascript" src="themes/js/jquery-ui.min.js"></script>
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
			Our store specializes in providing the newest and most reputable quality products on the market today
				<br/>Visit our store page and don't miss out on new products!
			</section>
		<hr>
		<h4><span>New products</span></h4>
	</section>
	<section class="main-content">
		
		<div class="row">						
			<div class="span9">								
				<ul class="thumbnails listing-products">
				
				
				<?php if(isset($_GET["CatID"])){
					while($ProrowC = mysqli_fetch_assoc($resultProCat)){ ?>
          				
          			<li class="span3">
						<div class="product-box">
							<span class="sale_tag"></span>												
							<a href="product_detail.php?ProID=<?php echo $ProrowC['ProID'];?>"><img alt="" src="<?php echo $ProrowC['ProImage'];?>"></a><br/>
							<a href="product_detail.php?ProID=<?php echo $ProrowC['ProID'];?>" class="title"><?php echo $ProrowC['ProName'];?></a><br/>
							<a href="product_detail.php?ProID=<?php echo $ProrowC['ProID'];?>" class="category"><?php echo $ProrowC['ProShortDescript'];?></a>
							<p class="price"><?php echo $ProrowC['Price'];?>$</p>
						</div>
					</li> 			
          		<?php	} //end while
 				  } // end if 
					else if(isset($_GET["SupID"])){
					while($ProrowS = mysqli_fetch_assoc($resultProSup)){ ?>
          				
          			<li class="span3">
						<div class="product-box">
							<span class="sale_tag"></span>												
							<a href="product_detail.php?ProID=<?php echo $ProrowS['ProID'];?>"><img alt="" src="<?php echo $ProrowS['ProImage'];?>"></a><br/>
							<a href="product_detail.php?ProID=<?php echo $ProrowS['ProID'];?>" class="title"><?php echo $ProrowS['ProName'];?></a><br/>
							<a href="product_detail.php?ProID=<?php echo $ProrowS['ProID'];?>" class="category"><?php echo $ProrowS['ProShortDescript'];?></a>
							<p class="price"><?php echo $ProrowS['Price'];?>$</p>
						</div>
					</li> 									
					<?php } // end while
					 } // end if 
						else{
							while($Prorow = mysqli_fetch_assoc($resultPro)){ ?>
          				
          			<li class="span3">
						<div class="product-box">
							<span class="sale_tag"></span>												
							<a href="product_detail.php?ProID=<?php echo $Prorow['ProID'];?>"><img alt="" src="<?php echo $Prorow['ProImage'];?>"></a><br/>
							<a href="product_detail.php?ProID=<?php echo $Prorow['ProID'];?>" class="title"><?php echo $Prorow['ProName'];?></a><br/>
							<a href="product_detail.php?ProID=<?php echo $Prorow['ProID'];?>" class="category"><?php echo $Prorow['ProShortDescript'];?></a>
							<p class="price"><?php echo $Prorow['Price'];?>$</p>
						</div>
					</li>
					<?php } 
						} ?>
					
				</ul>								
				<hr>

	</div>
	<div class="span3 col">
		<div  id="menu-filter">
			<h3>Price</h3>
			<div>
				
			</div>
			<h3>Product Type</h3>
			<div>
				
			</div>
			<h3>Manufacturer</h3>
			<div>
				
			</div>

		</div>

	</div>
	
	<script type="text/javascript">
		$("#menu-filter").accordion();
	</script>

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
</script>
</body>
</html>