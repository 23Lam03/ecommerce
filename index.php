<!DOCTYPE html>
<html lang="vi">
	<head>
		<meta charset="utf-8">

		<title>Shopping Online Project</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<!--[if ie]><meta content='IE=8' http-equiv='X-UA-Compatible'/><![endif]-->
		<!-- bootstrap -->
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">      
		<link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="themes/css/font-awesome.min.css">
	<!-- <link rel="stylesheet" type="text/css" href="themes/css/font-awesome.min2.css"> -->
	<link rel="stylesheet" type="text/css" href="themes/css/font-awesome.min3.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
		<link href="themes/css/bootstrappage.css" rel="stylesheet"/>
		
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
	
	// Product All
	include("php/productrandom.php");
	
	
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
			<section class="main-content">
				<div class="row">
					<div class="span12">													
						<br/>
						<div class="row">
							<div class="span12">
								<h4 class="title">
									
									<span class="pull-left"><span class="text"><span class="line"><a href="product_detail.php"><strong>Phone</strong></a></span></span>
									</span>
									
									<span class="pull-right">
										<a class="left button" href="#myCarousel-3" data-slide="prev"></a><a class="right button" href="#myCarousel-3" data-slide="next"></a>
									</span>
								</h4>
								<div id="myCarousel-3" class="myCarousel carousel slide">
									<div class="carousel-inner">
										<div class="active item">
											<ul class="thumbnails">											
												<!--		Product Mobile		-->	
									<?php while($randomm = mysqli_fetch_assoc($resultranm)){ ?>
          										<li class="span3">
													<div class="product-box">
														<span class="sale_tag"></span>
														<p><a href="product_detail.php?ProID=<?php echo $randomm['ProID'];?>"><img src="<?php echo $randomm['ProImage']?>" alt="<?php echo $randomm['ProName'];?>" /></a></p>
                    <a href="product_detail.php?ProID=<?php echo $randomm['ProID'];?>" class="title"><?php echo $randomm['ProName']?></a><br/>
                    <a href="product_detail.php?ProID=<?php echo $randomm['ProID'];?>" class="category"><p class="price"><?php echo $randomm['Price']?>$</p></a>			
													</div>
												</li>
 								<?php } ?>											
											</ul>
										</div>
										<div class="item">
											<ul class="thumbnails">
									<?php while($randomm2 = mysqli_fetch_assoc($resultranm2)){ ?>
          										<li class="span3">
													<div class="product-box">
														<span class="sale_tag"></span>
														<p><a href="product_detail.php?ProID=<?php echo $randomm2['ProID'];?>"><img src="<?php echo $randomm2['ProImage']?>" alt="" /></a></p>
														<a href="product_detail.php?ProID=<?php echo $randomm2['ProID'];?>" class="title"><?php echo $randomm2['ProName']?></a><br/>
														<a href="product_detail.php?ProID=<?php echo $randomm2['ProID'];?>" class="category"><p class="price"><?php echo $randomm2['Price']?>$</p></a>		
													</div>
												</li>
 								<?php } ?>											
											</ul>
										</div>

										<!-- -->
											<div class="item">
											<ul class="thumbnails">
									<?php while($randomm3 = mysqli_fetch_assoc($resultranm3)){ ?>
          										<li class="span3">
													<div class="product-box">
														<span class="sale_tag"></span>
														<p><a href="product_detail.php?ProID=<?php echo $randomm3['ProID'];?>"><img src="<?php echo $randomm3['ProImage']?>" alt="" /></a></p>
														<a href="product_detail.php?ProID=<?php echo $randomm3['ProID'];?>" class="title"><?php echo $randomm3['ProName']?></a><br/>
														<a href="product_detail.php?ProID=<?php echo $randomm3['ProID'];?>" class="category"><p class="price"><?php echo $randomm3['Price']?>$</p></a>		
													</div>
												</li>
 									<?php } ?>																	
											</ul>
										</div>
									</div>							
								</div>
							</div>						
						</div>
						<br/>
						<div class="row">
							<div class="span12">
								<h4 class="title">
									
									<span class="pull-left"><span class="text"><span class="line"><a href="product_detail.php"><strong>Laptop</strong></a></span></span>
									</span>
									
									<span class="pull-right">
										<a class="left button" href="#myCarousel-4" data-slide="prev"></a><a class="right button" href="#myCarousel-4" data-slide="next"></a>
									</span>
								</h4>
								<div id="myCarousel-4" class="myCarousel carousel slide">
									<div class="carousel-inner">
										<div class="active item">
											<ul class="thumbnails">	
											<!--		Product Laptop		-->
									<?php while($randoml = mysqli_fetch_assoc($resultranl)){ ?>
          										<li class="span3">
													<div class="product-box">
														<span class="sale_tag"></span>
														<p><a href="product_detail.php?ProID=<?php echo $randoml['ProID'];?>"><img src="<?php echo $randoml['ProImage']?>" alt="" /></a></p>
														<a href="product_detail.php?ProID=<?php echo $randoml['ProID'];?>" class="title"><?php echo $randoml['ProName']?></a><br/>
														<a href="product_detail.php?ProID=<?php echo $randoml['ProID'];?>" class="category"><p class="price"><?php echo $randoml['Price']?>$</p></a>		
													</div>
												</li>
 								<?php } ?>															
											</ul>
										</div>
										<div class="item">
											<ul class="thumbnails">
									<?php while($randoml2 = mysqli_fetch_assoc($resultranl2)){ ?>
          										<li class="span3">
													<div class="product-box">
														<span class="sale_tag"></span>
														<p><a href="product_detail.php?ProID=<?php echo $randoml2['ProID'];?>"><img src="<?php echo $randoml2['ProImage']?>" alt="" /></a></p>
														<a href="product_detail.php?ProID=<?php echo $randoml2['ProID'];?>" class="title"><?php echo $randoml2['ProName']?></a><br/>
														<a href="product_detail.php?ProID=<?php echo $randoml2['ProID'];?>" class="category"><p class="price"><?php echo $randoml2['Price']?>$</p></a>		
													</div>
												</li>
 									<?php } ?>											
											</ul>
										</div>

										<!-- -->
											<div class="item">
											<ul class="thumbnails">
									<?php while($randoml3 = mysqli_fetch_assoc($resultranl3)){ ?>
          										<li class="span3">
													<div class="product-box">
														<span class="sale_tag"></span>
														<p><a href="product_detail.php?ProID=<?php echo $randoml3['ProID'];?>"><img src="<?php echo $randoml3['ProImage']?>" alt="" /></a></p>
														<a href="product_detail.php?ProID=<?php echo $randoml['ProID'];?>" class="title"><?php echo $randoml3['ProName']?></a><br/>
														<a href="product_detail.php?ProID=<?php echo $randoml3['ProID'];?>" class="category"><p class="price"><?php echo $randoml3['Price']?>$</p></a>		
													</div>
												</li>
 									<?php } ?>											
											</ul>
										</div>
										<!-- -->

									</div>							
								</div>
							</div>						
						</div>
						<br/>
						<div class="row">
							<div class="span12">
								<h4 class="title">
									
									<span class="pull-left"><span class="text"><span class="line"><a href="product_detail.php"><strong>Tablet</strong></a></span></span>
									</span>
									
									<span class="pull-right">
										<a class="left button" href="#myCarousel-5" data-slide="prev"></a><a class="right button" href="#myCarousel-5" data-slide="next"></a>
									</span>
								</h4>
								<div id="myCarousel-5" class="myCarousel carousel slide">
									<div class="carousel-inner">
										<div class="active item">
											<ul class="thumbnails">											<!--		Product Tablet		-->	
									<?php while($randomt = mysqli_fetch_assoc($resultrant)){ ?>
          										<li class="span3">
													<div class="product-box">
														<span class="sale_tag"></span>
														<p><a href="product_detail.php?ProID=<?php echo $randomt['ProID'];?>"><img src="<?php echo $randomt['ProImage']?>" alt="" /></a></p>
														<a href="product_detail.php?ProID=<?php echo $randomt['ProID'];?>" class="title"><?php echo $randomt['ProName']?></a><br/>
														<a href="product_detail.php?ProID=<?php echo $randomt['ProID'];?>" class="category"><p class="price"><?php echo $randomt['Price']?>$</p></a>	
													</div>
												</li>
 									<?php } ?>							
											</ul>
										</div>
										<div class="item">
											<ul class="thumbnails">
										<?php while($randomt2 = mysqli_fetch_assoc($resultrant2)){ ?>
          										<li class="span3">
													<div class="product-box">
														<span class="sale_tag"></span>
														<p><a href="product_detail.php?ProID=<?php echo $randomt2['ProID'];?>"><img src="<?php echo $randomt2['ProImage']?>" alt="" /></a></p>
														<a href="product_detail.php?ProID=<?php echo $randomt2['ProID'];?>" class="title"><?php echo $randomt2['ProName']?></a><br/>
														<a href="product_detail.php?ProID=<?php echo $randomt2['ProID'];?>" class="category"><p class="price"><?php echo $randomt2['Price']?>$</p></a>	
													</div>
												</li>
 									   <?php } ?>			
											</ul>
										</div>
										<!-- -->
										<div class="item">
											<ul class="thumbnails">
										<?php while($randomt3 = mysqli_fetch_assoc($resultrant3)){ ?>
          										<li class="span3">
													<div class="product-box">
														<span class="sale_tag"></span>
														<p><a href="product_detail.php?ProID=<?php echo $randomt3['ProID'];?>"><img src="<?php echo $randomt3['ProImage']?>" alt="" /></a></p>
														<a href="product_detail.php?ProID=<?php echo $randomt3['ProID'];?>" class="title"><?php echo $randomt3['ProName']?></a><br/>
														<a href="product_detail.php?ProID=<?php echo $randomt3['ProID'];?>" class="category"><p class="price"><?php echo $randomt3['Price']?>$</p></a>	
													</div>
												</li>
 									    <?php } ?>		
											</ul>
										</div>
										<!-- -->

									</div>							
								</div>
							</div>						
						</div>
						<br/>
						
					</div>		

				</div>	
			</section>
			<div class="row feature_box">						
				<div class="span4">
					<div class="service">
						<div class="responsive">	
							<img src="themes/images/feature_img_2.png" alt="" />
							<h4>DESIGN <strong>MODERN</strong></h4>
							<p>The products are designed with modern and trendy designs in accordance with current user trends.</p>
						</div>
					</div>
				</div>
				<div class="span4">	
					<div class="service">
						<div class="customize">			
							<img src="themes/images/feature_img_1.png" alt="" />
							<h4>DELIVERY <strong>FREE OF CHARGE</strong></h4>
							<p>Products are delivered quickly and neatly in many forms to meet customer requirements.</p>
						</div>
					</div>
				</div>
				<div class="span4">
					<div class="service">
						<div class="support">	
							<img src="themes/images/feature_img_3.png" alt="" />
							<h4>SERVE <strong>24/7</strong></h4>
							<p>Customers are always the top priority and are served 24/7.</p>
						</div>
					</div>
				</div>
			</div>
			
		
    </body>
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
</html>