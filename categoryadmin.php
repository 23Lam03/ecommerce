
<!DOCTYPE HTML>
<html>
<head>
<title>Admin</title>
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


<?php
	
	require_once("connectDB.php");
	
	include("php/admin/selectcat.php");
	
	// Code Insert Category
	if (isset($_POST["btncatadd"])){
			$idcat= $_POST['txtid'];
			$namecat = $_POST['txtname'];
			// Check ID duplicate
			$checkid= "SELECT * FROM category WHERE CatID = $idcat";
			$checkname = "SELECT * FROM category WHERE CatName = '$namecat'";
			$resultcheckid = mysqli_query($conn, $checkid);
			$resultcheckname = mysqli_query($conn, $checkname);
			if (mysqli_num_rows($resultcheckid) > 0)
					{
						echo'<script language="javascript">
						alert("ID already exists, please enter another ID");
						window.location="categoryadmin.php";</script>';
					}
			if (mysqli_num_rows($resultcheckname) > 0)
					{
						echo'<script language="javascript">
						alert("The product type name already exists, please choose another name");
						window.location="categoryadmin.php";</script>';
					}
			else{
			// Insert into database
			$strInsert="INSERT INTO category(CatID,CatName) values($idcat,'$namecat')";
			
			$insertCat =$conn->query($strInsert);
			echo '<script language="javascript">
			 	  alert("You have successfully added the product type");
				  window.location="categoryadmin.php";
			      </script>';
				}
	}
	
	//Update Category 
	
	if (isset($_POST["btncatupdate"])){
		$id = $_POST['txtid2'];
		$name= $_POST['txtname2'];
		$strUpdate= "UPDATE category
		SET CatID = $id,CatName = '$name'
		WHERE CatID = $id";

		$updateCat =$conn->query($strUpdate);
		echo '<script language="javascript">
			alert("You have successfully updated your information");
			window.location="categoryadmin.php";
			</script>';
		     }
	
	// Delete Category
	
	if (isset($_POST["btncatdelete"])){
		$id = $_POST['txtid3'];
		$strDelete= "DELETE FROM category
		WHERE CatID = $id";

		$deleteCat =$conn->query($strDelete);
		echo '<script language="javascript">
			alert("You have successfully deleted the product type");
			window.location="categoryadmin.php";
			</script>';
		     }
	
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
												<span><?php echo "Chào bạn $admin"; ?></span>
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
                <li class="breadcrumb-item"><a href="admin.php">Home page</a><i class="fa fa-angle-right"></i>Product type</li>
            </ol>

<!-- grids -->
				<div class="grids">
					<div class="agile-calendar-grid">
						<div class="page">
							
							<div class="w3l-calendar-left">
								<div class="calendar-heading">								
 					<div class="agile-tables">
					<div class="w3l-table-info">
					  <h2>Add - Delete - Edit Product Type</h2>
					  <div class="row">
					  	<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
					  		
					  	</div>
					  	<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
					  	<?php
							// Form Edit
							if(isset($_GET["EditID"])){ 
								$rowupdate = mysqli_fetch_assoc($resultCat)
						?>
				  		    <form action="categoryadmin.php" method="post">
							<div class="form-group">
							  <label for="ma">Product type code:</label>
							  <input type="text" class="form-control" name="txtid2" value="<?php echo $rowupdate['CatID'] ?>">
							</div>
							<div class="form-group">
							  <label for="ten">Product type name:</label>
							  <input type="text" class="form-control" name="txtname2" value="<?php echo $rowupdate['CatName'] ?>">
							</div>
							<button type="submit" class="btn btn-default" name="btncatupdate">Update</button>
						<?php }
							
							// Form Delete
							else if(isset($_GET["DelID"])){ 
								$rowdelete = mysqli_fetch_assoc($resultCat2)
						?>
				  		    <form action="categoryadmin.php" method="post">
							<div class="form-group">
							  <label for="ma">Product type code:</label>
							  <input type="text" class="form-control" name="txtid3" value="<?php echo $rowdelete['CatID'] ?>">
							</div>
							<div class="form-group">
							  <label for="ten">Product type name:</label>
							  <input type="text" class="form-control" name="txtname3" value="<?php echo $rowdelete['CatName'] ?>">
							</div>
							<button type="submit" class="btn btn-default" name="btncatdelete">Delete</button>
						<?php } 
							
							//Form Add Category
							else { ?>
							</form>
					  		<form action="categoryadmin.php" method="post">
							<div class="form-group">
							  <label for="ma">Product type code:</label>
							  <input type="text" class="form-control" name="txtid" required>
							</div>
							<div class="form-group">
							  <label for="ten">Product type name:</label>
							  <input type="text" class="form-control" name="txtname" required>
							</div>
							
							<button type="submit" class="btn btn-default" name="btncatadd">Add product type</button>
							</form>
							<?php } ?>
					  	</div>
					  </div>
					  <h2>Product categories</h2>
					    <table id="table">
						<thead >
						  <tr >
							<th>Product type code</th>
							<th>Product type name</th>
							
							<th>Edit</th>
						  </tr>
						</thead>
						<tbody>
					   <?php 
							while($row = (mysqli_fetch_assoc($result1))){
						?>
						   <tr class="info">
							<td><?php echo $row['CatID'] ?></td>
							<td><?php echo $row['CatName'] ?></td>
							
							<td style="text-align: center;">
							<span >
								<a class="agile-icon" href="categoryadmin.php?EditID=<?php echo $row['CatID'] ?>"><i class="fa fa-pencil-square-o"></i></a>
							</span> 
							<span>
								<a class="agile-icon" href="categoryadmin.php?DelID=<?php echo $row['CatID'] ?>"><i class="fa fa-times-circle"></i></a>
							</span>
			
							</td>
						  </tr>
						<?php  } ?>
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
	 <p>Henzo</p>
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
											<li id="menu-academico-avaliacoes" ><a href="supplieradmin.php">Producer</a></li>
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