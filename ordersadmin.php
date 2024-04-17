
<!DOCTYPE HTML>
<html>
<head>
	<title>dashboard</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="laptop" />
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
	<!-- Custom CSS -->
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	<link rel="stylesheet" href="css/morris.css" type="text/css"/>
	<!-- Graph CSS -->
	<link href="css/font-awesome.css" rel="stylesheet"> 
	<!-- jQuery -->
	<script src="js/jquery-2.1.4.min.js"></script>
	<!-- //jQuery -->
<!-- <link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
	<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'> -->
	<!-- lined-icons -->
	<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />

	<!-- tables -->
	<link rel="stylesheet" type="text/css" href="css/table-style.css" />
	<link rel="stylesheet" type="text/css" href="css/basictable.css" />
	<script type="text/javascript" src="js/jquery.basictable.min.js"></script>

</head> 


<!--Code PHP -->
<?php 
	
	require_once("connectDB.php");
	
	include("php/admin/selectorder.php");
?>


<body>
	<div class="page-container">
		<!--/content-inner-->
		<div class="left-content">
			<div class="mother-grid-inner">
				<!--header start here-->
				<div class="header-main">
					
					<div class="profile_details w3l">		
								<ul>
									<li class="dropdown profile_details_drop">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
											<div class="profile_img">	
												<span class="prfil-img"><img src="images/admin.jpg" alt=""> </span> 
												<div class="user-name">
												 <?php 
													session_start();
													if(isset($_SESSION['Admin'])){
													$admin=$_SESSION['Admin'];?>	
												<span><?php echo "Hello $admin"; ?></span>
												<?php
														 }
														else{
														echo'<script language="javascript">
															alert("Please log in with admin rights");
															window.location="register.php";
															</script>';	
														}
														?>								
												</div>
												<i class="fa fa-angle-down"></i>
												<i class="fa fa-angle-up"></i>
												<div class="clearfix"></div>	
											</div>	
										</a>
										<ul class="dropdown-menu drp-mnu">
											<li> <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a> </li>
										</ul>
									</li>
								</ul>
							</div>
					
					<div class="clearfix"> </div>	
				</div>
				<!--heder end here-->
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="admin.php">Home page</a><i class="fa fa-angle-right"></i>Order</li>
				</ol>

				<!-- grids -->
				<div class="grids">
					
					
					
					<div class="agile-calendar-grid">
						<div class="page">
							
							<div class="w3l-calendar-left">
								<div class="calendar-heading">					
									<div class="agile-tables">
										<div class="w3l-table-info">
											<h2>List of orders</h2>
											<table id="table">
												<thead>
													<tr>
													<th>Order code</th>
													<th>Customer name</th>
													<th>Address</th>
													<th>Phone number</th>
													<th>Date of establishment</th>
													</tr>
												</thead>
												<tbody>
													<?php 
														while($row = (mysqli_fetch_assoc($resultorder))){
													?>
													<tr class="danger">
														<td><?php echo $row['OrderID'] ?></td>
														<td><?php echo $row['CustName'] ?></td>
														<td><?php echo $row['CustAddress'] ?></td>
														<td><?php echo $row['CustPhone'] ?></td>
														<td><?php echo $row['OrderDate'] ?></td>
													</tr>	
													<?php } ?>
												</tbody>
											</table>
										</div>
									</div>
</div>
</div>

<div class="clearfix"> </div>
</div>
</div>
</div>
<!-- //grids -->
<!--photoday-section-->	


<div class="col-sm-4 wthree-crd">
	<div class="card">
		<div class="card-body">
			
		</div>
	</div>
</div>

<div class="clearfix"></div>

<!--//photoday-section-->	
<!-- script-for sticky-nav -->
<script>
	$(document).ready(function() {
		var navoffeset=$(".header-main").offset().top;
		$(window).scroll(function(){
			var scrollpos=$(window).scrollTop(); 
			if(scrollpos >=navoffeset){
				$(".header-main").addClass("fixed");
			}else{
				$(".header-main").removeClass("fixed");
			}
		});
		
	});
</script>
<!-- /script-for sticky-nav -->
<!--inner block start here-->
<div class="inner-block">

</div>
<!--inner block end here-->
<!--copy rights start here-->
<div class="copyrights">
	<p>Henzo </p>
</div>	
<!--COPY rights end here-->
</div>
</div>
<!--//content-inner-->
<!--/sidebar-menu-->
<div class="sidebar-menu">
	<header class="logo1">
		<a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> 
	</header>
	<div style="border-top:1px ridge rgba(255, 255, 255, 0.15)"></div>
	<div class="menu">
									<ul id="menu" >
										<li><a href="admin.php"><i class="fa fa-tachometer"></i> <span>Home page</span><div class="clearfix"></div></a></li>
										
										
										 <li id="menu-academico" ><a href="ordersadmin.php"><i class="fa fa-envelope nav_icon"></i><span>Order</span><div class="clearfix"></div></a></li>
									<!-- <li><a href="gallery.html"><i class="fa fa-picture-o" aria-hidden="true"></i><span>Gallery</span><div class="clearfix"></div></a></li> -->
									
									 <li id="menu-academico" ><a href="#"><i class="fa fa-list-ul" aria-hidden="true"></i><span>Product</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
									 <ul id="menu-academico-sub" >
										<li id="menu-academico-avaliacoes" ><a href="productadmin.php">Product Management</a></li>
										<li id="menu-academico-avaliacoes" ><a href="categoryadmin.php">Product type</a></li>
										<li id="menu-academico-avaliacoes" ><a href="supplieradmin.php">Manufacturer</a></li>
										  </ul>
										</li>
								 		<ul id="menu-academico-sub" >
											<li id="menu-academico-boletim" ><i class="fa fa-file-text-o"></i><a href="index.php">Back to Homepage</a></li>

										</ul>

								  </ul>
								</div>
		</div>
		<div class="clearfix"></div>		
	</div>
	<script>
		var toggle = true;
		
		$(".sidebar-icon").click(function() {                
			if (toggle)
			{
				$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
				$("#menu span").css({"position":"absolute"});
			}
			else
			{
				$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
				setTimeout(function() {
					$("#menu span").css({"position":"relative"});
				}, 400);
			}
			
			toggle = !toggle;
		});
	</script>
	<!--js -->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.min.js"></script>
	<!-- /Bootstrap Core JavaScript -->	   
	<!-- morris JavaScript -->	
	<script src="js/raphael-min.js"></script>

</body>
</html>