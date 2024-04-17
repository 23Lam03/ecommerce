
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

<!--Cac code PHP-->
<?php 
	
	require_once("connectDB.php");
	
	include("php/admin/selectpro.php");
	
	
	// Check upload image
	
	if($_FILES){ 
			
			$filename = $_FILES["prophoto"]["tmp_name"]; 
			$path = "themes/images/".$_FILES["prophoto"]["name"];
			move_uploaded_file($filename,$path); 
		}
	// Insert Products
	
	if (isset($_POST["btnproadd"])){
			$proname = $_POST['txtname'];
			$prodescript = $_POST['comment1'];
			$proshortdescript = $_POST['comment2'];
			$prophoto = $path;
			$proqty = $_POST['txtqty'];
			$proprice = $_POST['txtprice'];
			$procat = $_POST['optcat'];
			$procatid = $_POST['optcat'];
			$prosup = $_POST['optsup'];
				
			
			// Insert into database
			$strInsert="INSERT INTO product(ProName, ProDescription, ProShortDescript, ProImage, Quantity, Price, CatID, SupID) values('$proname','$prodescript','$proshortdescript','$prophoto', $proqty, $proprice, $procat, $prosup)";
			
			$insertPro =$conn->query($strInsert);
			echo '<script language="javascript">
			 	  alert("You have successfully added the product");
				  window.location="productadmin.php";
			      </script>';
				
	}
	
	// Update Product
	
	if (isset($_POST["btnproupdate"])){
			$proid= $_POST['txtidup'];
			$proname = $_POST['txtnameup'];
			$prodescript = $_POST['comment1up'];
			$proshortdescript = $_POST['comment2up'];
			$prophoto = $path;
			$proqty = $_POST['txtqtyup'];
			$proprice = $_POST['txtpriceup'];
			$procat = $_POST['optcatup'];
			$prosup = $_POST['optsupup'];
		
		$strUpdate= "UPDATE product
		SET ProName = '$proname', ProDescription = '$prodescript' , ProShortDescript = '$proshortdescript', ProImage = '$prophoto', Quantity = $proqty, Price = $proprice, CatID = $procat, SupID = $prosup
		WHERE ProID = $proid";

		$updatePro =$conn->query($strUpdate);
		echo '<script language="javascript">
			alert("You have successfully updated your information");
			window.location="productadmin.php";
			</script>';
		}
	
	// Delete Product
	
	if (isset($_POST["btnprodelete"])){
		$proid= $_POST['txtid'];
		$strDelete= "DELETE FROM product
		WHERE ProID = $proid";

		$deletePro =$conn->query($strDelete);
		echo '<script language="javascript">
			alert("You have successfully deleted the product type");
			window.location="productadmin.php";
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
                <li class="breadcrumb-item"><a href="admin.php">Home page</a><i class="fa fa-angle-right"></i>Product</li>
            </ol>

<!-- grids -->
				<div class="grids">
				
					
				
					<div class="agile-calendar-grid">
						<div class="page">
							
							<div class="w3l-calendar-left">
								<div class="calendar-heading">
<!-- 									<p>Noi dung</p>
 -->								
 					<div class="agile-tables">
					<div class="w3l-table-info">
					  <h2>Add - Delete - Edit products</h2>
					  <div class="row">
					  	<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
					  		
					  	</div>
					  	<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
					  	<?php
							// Form Update
						if(isset($_GET["EditID"])){
							$rowupdate = mysqli_fetch_assoc($resultPro);
						 ?>
					  		<form action="productadmin.php" enctype="multipart/form-data" method="post">
							<div class="form-group">
							  <label for="ma">Product code</label>
							  <input type="text" class="form-control" name="txtidup" value="<?php echo $rowupdate['ProID'] ?>">
							</div>
							<div class="form-group">
							  <label for="ten">Product's name</label>
							  <input type="text" class="form-control" name="txtnameup" value="<?php echo $rowupdate['ProName'] ?>">
							</div>
							<div class="form-group">
						      <label for="comment">Describe</label>
						      <textarea class="form-control" rows="10" name="comment1up"><?php echo $rowupdate['ProDescription'] ?></textarea>
						    </div>
						    <div class="form-group">
						      <label for="comment">Short description</label>
						      <textarea class="form-control" rows="3" name="comment2up"><?php echo $rowupdate['ProShortDescript'] ?></textarea></textarea>
						    </div>
							<div class="form-group">
						      <label for="comment">Image</label>
								<input type="file" name="prophoto" />
							  </td>
						    </div>
						    <div class="form-group">
							  <label for="gia">Quantity</label>
							  <input type="text" class="form-control" name="txtqtyup" value="<?php echo $rowupdate['Quantity'] ?>">
							</div>
						  	<div class="form-group">
							  <label for="gia">Price</label>
							  <input type="text" class="form-control" name="txtpriceup" value="<?php echo $rowupdate['Price'] ?>">
							</div>
							
							<div class="form-group">
							  <label for="loai">Type</label>
							  <select name="optcatup">
							  	<option>Select product type</option>
							 <?php 
							while($row6 = (mysqli_fetch_assoc($result4))){
							 ?>
							  	<option value="<?php echo $row6['CatID'] ?>"><?php echo $row6['CatName'] ?></option> <?php } ?>
							  </select>
							</div>
							
							<div class="form-group">
							  <label for="nsx">Producer</label>
							  <select name="optsupup">
							  	<option value="">Select manufacturer</option>
							 <?php 
							while($row6 = (mysqli_fetch_assoc($result5))){
							 ?>
							  	<option value="<?php echo $row6['SupID'] ?>"><?php echo $row6['SupName'] ?></option>
							  <?php } ?>
							  </select>
							</div>
							<button type="submit" class="btn btn-default" name="btnproupdate">Update</button>
							</form>
					    <?php } 
							
							else if(isset($_GET["DelID"])){
							$rowdelete = mysqli_fetch_assoc($resultPro2); ?>
							<form action="productadmin.php" enctype="multipart/form-data" method="post">
							<div class="form-group">
							  <label for="ma">Product code</label>
							  <input type="text" class="form-control" name="txtid" value="<?php echo $rowdelete['ProID'] ?>">
							</div>
							<div class="form-group">
							  <label for="ten">Product's name</label>
							  <input type="text" class="form-control" name="txtname" value="<?php echo $rowdelete['ProName'] ?>">
							</div>
							<div class="form-group">
						      <label for="comment">Describe</label>
						      <textarea class="form-control" rows="10" name="comment1"><?php echo $rowdelete['ProDescription'] ?></textarea>
						    </div>
						    <div class="form-group">
						      <label for="comment">Short description</label>
						      <textarea class="form-control" rows="3" name="comment2"><?php echo $rowdelete['ProShortDescript'] ?></textarea></textarea>
						    </div>
							<div class="form-group">
						      <label for="comment">Image</label>
						      <td width="343"><img src="<?php echo $rowdelete['ProImage'] ?>" width="70px" height="70px" /><br>
							  </td>
						    </div>
						    <div class="form-group">
							  <label for="gia">Quantity</label>
							  <input type="text" class="form-control" name="txtqty" value="<?php echo $rowdelete['Quantity'] ?>">
							</div>
						  	<div class="form-group">
							  <label for="gia">Price</label>
							  <input type="text" class="form-control" name="txtprice" value="<?php echo $rowdelete['Price'] ?>">
							</div>
						  	<div class="form-group">
							  <label for="loai">Loại</label>
							  <select name="optcat">
							  	
							  	<option value="<?php echo $rowdelete['CatID'] ?>"><?php echo $rowdelete['CatName']?></option>
							  </select>
							</div>
							<div class="form-group">
							  <label for="nsx">Producer</label>
							  <select name="optsup">
							  	
							  	<option value="<?php echo $rowdelete['SupID']?>"><?php echo $rowdelete['SupName']?></option>
							  </select>
							</div>
							<button type="submit" class="btn btn-default" name="btnprodelete">Delete</button>
							</form>
							<?php } 
							
							else { ?>
							<form action="productadmin.php" enctype="multipart/form-data" method="post">
							<div class="form-group">
							  <label for="ten">Product's name</label>
							  <input type="text" class="form-control" name="txtname">
							</div>
							<div class="form-group">
						      <label for="comment">Describe</label>
						      <textarea class="form-control" rows="10" name="comment1"></textarea>
						    </div>
						    <div class="form-group">
						      <label for="comment">Short description</label>
						      <textarea class="form-control" rows="3" name="comment2"></textarea>
						    </div>
							<div class="form-group">
						      <label for="comment">Image</label>
						      
								<input type="file" name="prophoto" />
							  </td>
						    </div>
						    <div class="form-group">
							  <label for="gia">Quantity</label>
							  <input type="text" class="form-control" name="txtqty">
							</div>
						  	<div class="form-group">
							  <label for="gia">Price</label>
							  <input type="text" class="form-control" name="txtprice">
							</div>
						  	<div class="form-group">
							  <label for="loai">Type</label>
							  <select name="optcat">
							  	<option>Select product type</option>
							 <?php 
							while($row4 = (mysqli_fetch_assoc($result4))){
							 ?>
							  	<option value="<?php echo $row4['CatID'] ?>"><?php echo $row4['CatName'] ?></option> <?php } ?>
							  </select>
							</div>
							<div class="form-group">
							  <label for="nsx">Producer</label>
							  <select name="optsup">
							  	<option value="">Select manufacturer</option>
							 <?php 
							while($row5 = (mysqli_fetch_assoc($result5))){
							 ?>
							  	<option value="<?php echo $row5['SupID'] ?>"><?php echo $row5['SupName'] ?></option>
							  <?php } ?>
							  </select>
							</div>
							<button type="submit" class="btn btn-default" name="btnproadd">Add products</button>
							</form>
							<?php } ?>
							
					  	</div>
					  	<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
					  		
					  	</div>
					  </div>
					  <h2>All products</h2>
					    <table id="table" border="1px">
						<thead >
						  <tr >
						  <th>Product code</th>
							<th>Product name</th>
							<th style="text-align: center;">Description</th>
							<th>Short description</th>
							<th>Image</th>
							<th>Quantity</th>
							<th>Selling price</th>
							<th>Type</th>
							<th>Manufacturer</th>
							<th>Edit</th>
						  </tr>
						</thead>
						<tbody>
					   <?php 
							while($row3 = (mysqli_fetch_assoc($result3))){
						?>
						   <tr class="info">
							<td><?php echo $row3['ProID'] ?></td>
							<td><?php echo $row3['ProName'] ?></td>
							<td><?php echo $row3['ProDescription'] ?></td>
							<td><?php echo $row3['ProShortDescript'] ?></td>
							<td><img width="70px" height="70px" src="<?php echo $row3['ProImage'] ?>" alt=""></td>
							<td><?php echo $row3['Quantity'] ?></td>
							<td><?php echo $row3['Price'] ?>$</td>
							<td><?php echo $row3['CatName'] ?></td>
							<td><?php echo $row3['SupName'] ?></td>
							<td style="text-align: center;">
							<span >
								<a class="agile-icon" href="productadmin.php?EditID=<?php echo $row3['ProID'];?>"><i class="fa fa-pencil-square-o"></i></a>
							</span> 
							<span>
								<a class="agile-icon" href="productadmin.php?DelID=<?php echo $row3['ProID'];?>"><i class="fa fa-times-circle"></i></a>
							</span>
			
							</td>
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