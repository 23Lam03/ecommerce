<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Register</title>
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
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	</head>
   
   <!--  Cac doan code php -->
 
  <?php 
	
	require_once("connectDB.php");
	
	// Menu 
	
	include("php/menu.php");
	
	// Product All
	//include("php/productrandom.php");
	
	
	//Register
	if (isset($_POST["btnregister"])){
			$username= $_POST['txtusername'];
			$password = $_POST['txtpassword'];
			$name= $_POST['txtname'];
		    $gender = $_POST['rdgender'];
			$dob= $_POST['txtdob'];
			$address= $_POST['txtaddress'];	
			$phone= $_POST['txtphone'];
		    $email= $_POST['txtemail'];
			// Check UserName duplicate
			$kiemtrauser = "SELECT * FROM customer WHERE Username = '$username'";
			$kiemtraemail = "SELECT * FROM customer WHERE CustEmail = '$email'";
			$resultuser = mysqli_query($conn, $kiemtrauser);
			$resultemail = mysqli_query($conn, $kiemtraemail);
			if (mysqli_num_rows($resultuser) > 0)
					{
						echo'<script language="javascript">
						alert("Username is already taken, please choose another username");
						window.location="register.php";</script>';
						die ();
					}
			else if (mysqli_num_rows($resultemail) > 0)
					{
						echo'<script language="javascript">
						alert("Email has been used, please select another email");
						window.location="register.php";</script>';
						die ();
					}
			else{
			// Insert into database
			$strInsert="INSERT INTO customer(Username,Password,CustName,CustGender,CustDOB,CustAddress,CustPhone,CustEmail) values('$username','$password','$name','$gender','$dob','$address','$phone','$email')";
			
			$insertCus =$conn->query($strInsert);
			echo '<script language="javascript">
			 	  alert("You have successfully registered");
				  window.location="index.php"
			      </script>';
				}
	}
	
	//Login
	if (isset($_POST["btnlogin"])){
			$user =$_POST["txtusername"];
			$pass =$_POST["txtpassword"];
			$queryUser=" SELECT * FROM customer WHERE Username='$user' AND Password ='$pass'";
			$queryAdmin=" SELECT * FROM admin WHERE Username='$user' AND Password ='$pass'";
			$resultAcc1 = $conn->query($queryUser);
			$resultAcc2 = $conn->query($queryAdmin);
			$row =mysqli_fetch_assoc($resultAcc1);
			$row2 =mysqli_fetch_assoc($resultAcc2);
			if($row["Username"]==$user && $row["Password"]==$pass){
					session_start();
					$_SESSION['User']=$row["Username"];
					$_SESSION['id']=$row["CustID"];
					echo '<script language="javascript">
			 	  		 alert("Successful login");
				  		window.location="index.php";
			      		 </script>';
				
			}
			else if ($row2["Username"]==$user && $row2["Password"]==$pass){
					session_start();
					$_SESSION['Admin']=$row2["Username"];
					echo '<script language="javascript">
			 	  		 alert("Successfully logged in to the admin page");
				  		 window.location="admin.php";
						 </script>';		
			}
			else{
					echo '<script language="javascript">
			 	  		 alert("You entered the wrong username or password, please re-enter");
				  		 window.location="register.php";
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
					<a href="index.php" class="logo pull-left"><h4 class="title">HENZOSHOP</h4></a>
					<nav id="menu" class="pull-right">
						<ul>
						<li><a href="index.php">Home</a></li>
						<li><a href="products.php">Products</a>
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
							<li><a href="products.php">Contact</a></li>
							
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
				<h4><span>Login and Register</span></h4>
			</section>			
			<section class="main-content">				
				<div class="row">
					<div class="span5">					
						<h4 class="title"><span class="text"><strong>Log</strong> in</span></h4>
						<form action="register.php" method="post" name="formdangnhap">
							<input type="hidden" name="next" value="/">
							<fieldset>
								<div class="control-group">
									<label class="control-label">User name</label>
									<div class="controls">
										<input type="text" placeholder="Username" class="input-xlarge" name="txtusername" required>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Password</label>
									<div class="controls">

										<input type="password" placeholder="Password" class="input-xlarge" name="txtpassword" required>
									</div>
								</div>
								<label>
							        <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember password
							    </label>
							    <hr>
								<div class="control-group">
									<input tabindex="3" class="btn btn-primary large" type="submit" name="btnlogin" onclick="validate()" value="Login">
								</div>
							</fieldset>
						</form>				
					</div>
					<div class="span7">					
						<h4 class="title"><span class="text"><strong>Register</strong></span></h4>
						<form action="register.php" method="post" class="form-stacked" name="formdangky">
							<fieldset>
								<div class="control-group">
									<label class="control-label">User name</label>
									<div class="controls">
										<input type="text" placeholder="EnterUsername" class="input-xlarge"
										name="txtusername" required>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Email</label>
									<div class="controls">
										<input type="text" placeholder="Enter the format abc@gmail.com" class="input-xlarge" name="txtemail" required>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Password:</label>
									<div class="controls">
										<input type="password" placeholder="Enter password" class="input-xlarge" name="txtpassword" required>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">First and last name</label>
									<div class="controls">
										<input type="text" placeholder="Full Name"  class="input-xlarge"  name="txtname" required>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Date of birth</label>
									<div class="controls">
										<input type="date" class="input-xlarge"  name="txtdob" required>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Sex</label>
									<div>
										<input type="radio" name="rdgender" value="Male" required /> &nbsp; Male &nbsp;
										<input type="radio" name="rdgender" value = "Female" required /> &nbsp; Female
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Address</label>
									<div class="controls">
										<input type="text" placeholder="Enter the address"  class="input-xlarge"  name="txtaddress" required>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Phone number</label>
									<div class="controls">
										<input type="text" placeholder="Enter your phone number" class="input-xlarge" name="txtphone" required>
									</div>
						</div>							                            
								<hr>
								<div class="actions"><input tabindex="9" class="btn btn-primary large" id="submit1" onclick="validate1()" type="submit" name="btnregister" value="Create Account"></div>
							</fieldset>
							
						</form>					
					</div>				
				</div>
			</section>			
			<section style="background-color: #857474;" id="footer-bar">
				<div class="row">
					<div class="span3">
					<h4>Navigation</h4>
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
		<script type="text/javascript">
			// Check form validation
			function validate(){
				if( document.formdangnhap.txtusername.value == "" ) {
            		alert( "Vui lòng nhập username" );
            		document.formdangnhap.txtusername.focus() ;
            		return false;
         		}
				if( document.formdangnhap.txtpassword.value == "" ) {
            		alert( "Vui lòng nhập password" );
            		document.formdangnhap.txtpassword.focus() ;
            		return false;
         		}
			}
			function validate1(){
				if( document.formdangky.txtusername.value == "" ) {
            		alert( "Vui lòng nhập username" );
            		document.formdangky.txtusername.focus() ;
            		return false;
         		}
				if( document.formdangky.txtemail.value == "" ) {
            		alert( "Vui lòng nhập email" );
            		document.formdangky.txtemail.focus() ;
            		return false;
         		}
				if( document.formdangky.txtpassword.value == "" ) {
            		alert( "Vui lòng nhập mật khẩu" );
            		document.formdangky.txtpassword.focus() ;
            		return false;
         		}
				if( document.formdangky.txtname.value == "" ) {
            		alert( "Vui lòng nhập họ tên của bạn" );
            		document.formdangky.txtname.focus() ;
            		return false;
         		}
				if( document.formdangky.txtdob.value == "" ) {
            		alert( "Vui lòng nhập ngày sinh" );
            		document.formdangky.txtdob.focus() ;
            		return false;
         		}
				if( document.formdangky.rdgender.checked == false ) {
            		alert( "Vui lòng chọn giới tính" );
            		document.formdangky.rdgender.focus() ;
            		return false;
         		}
				if( document.formdangky.txtaddress.value == "" ) {
            		alert( "Vui lòng nhập địa chỉ" );
            		document.formdangky.txtaddress.focus() ;
            		return false;
         		}
				if( document.formdangkyp.txtphone.value == "" ) {
            		alert( "Vui lòng nhập số điện thoại" );
            		document.formdangky.txtphone.focus() ;
            		return false;
         		}
			}
		</script>
    </body>
</html>