<!DOCTYPE html>
<html lang="en">
<head>
	<title>real estate</title>
	<meta charset="UTF-8">
	<meta name="description" content="Real-Estate">
	<meta name="keywords" content="LERAMIZ, unica, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->   
<!--	<link href="img/favicon.ico" rel="shortcut icon"/>-->

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/animate.css"/>
	<link rel="stylesheet" href="css/owl.carousel.css"/>
	<link rel="stylesheet" href="css/style.css"/>


</head>
<body>

	
	<!-- Header section -->
	<header class="header-section">
		<div class="header-top">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 header-top-left">
<!--						<div class="top-info ">-->
<!--							<h3>DashBoard</h3>-->
<!--						</div>-->
					</div>
					<div class="col-lg-6 text-lg-right header-top-right">
						<div class="user-panel">
							<a href="logout.php"><?php session_start(); echo $_SESSION['username']."  ";?><i class="fa fa-user-circle-o"></i>Logout</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="site-navbar">
<!--						<a href="#" class="site-logo"><img src="img/logo1.png" alt=""></a>-->
						<div class="nav-switch">
							<i class="fa fa-bars"></i>
						</div>
						<ul class="main-menu">
              <li><a href="normalHomeSale.php">FOR SALE</a></li>
<!--              <li><a href="normalHomeRent.php">FOR RENT</a></li>-->
<!--			  <li><a href="upcomingprojects.php">UPCOMING PROJECTS</a></li>-->

<!--							<li><a href="PackersAndMovers.php">PACKERS N MOVERS</a></li>-->

						</ul>
					</div>
				</div>
			</div>
		</div>
	</header>
	<!-- Header section end -->


	<!-- Hero section -->
	<section class="hero-section set-bg" data-setbg="img/san.jpg">
		<div class="container hero-text text-white">
			<h2>Buy our site here</h2>
<!--			<a href="addprojectsale.php" class="site-btn">Add Now</a>-->
		</div>
	</section>

	<!-- Hero section end -->
	<?php 
	include('indexDB.php');
	$loc=$c='';
	$x1="select distinct location from flat";
	$x2="select distinct city from flat";
	$q="select * from cardsale order by time desc";
	if(isset($_POST['loc']) && isset($_POST['city']))
	{
		$loc=$_POST['loc'];
		$c=$_POST['city'];
		if($loc=='All' && $c=='All')
		{
			$q="select * from cardsale order by time desc";
		}
		if($loc=='All' && $c!='All')
		{
			$q="select * from cardsale where city='$c' order by time desc";
		}
		if($loc!='All')
		{
			$x2="select city from cardsale where location='$loc'";
			$q="select * from cardsale where location='$loc' order by time desc";
		}
	}
	$r1=$conn->query($x1);
	$r2=$conn->query($x2);
	?>

	<section class="page-section categories-page">
		<br><br>
		<h2 align="center">All Properties</h2>
						<br><br>
		<div class="container">
			<div class="row">

				<?php
						$r = $conn->query($q);
						while($x=mysqli_fetch_array($r, MYSQLI_ASSOC))
						{
							?>
							<div class='col-md-4' style="height:300px;">
								<form action='single-list_sale.php?action=add&id=<?php echo $x['flat_id']; ?>' method="post">
								<div class='sale-notic'>FOR Sale</div>
									<div class='propertie-info text-white' style="background-image:url('<?php echo $x['image'] ?>');height:270px">
									<div class='info-warp'>
										<p><i class='fa fa-map-marker'></i><?php echo $x['location'] ?></p>
									</div>
									<button class='price' type='submit'><?php echo "Rs. ".$x['totalcost'] ?></button>
									</div>
									</form>
							</div>
				<?php
						}
				?>
			</div>
		</div>
		<br><br>

        </div>
	</section>

	<footer class="footer-section set-bg" data-setbg="img/san1.jpg">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6 footer-widget">

				</div>
				<div class="col-lg-3 col-md-6 footer-widget">
					<div class="contact-widget">
						<h5 class="fw-title">CONTACT US</h5>
						<p><i class="fa fa-map-marker"></i>Mangalore</p>
						<p><i class="fa fa-phone"></i>9449172365</p>
						<p><i class="fa fa-envelope"></i>sandeepperuvai@gmail.com</p>
						<p><i class="fa fa-clock-o"></i>Mon - Sat, 08 AM - 06 PM</p>
					</div>
				</div>

				<div class="col-lg-3 col-md-6  footer-widget">
					<div class="newslatter-widget">
						<h5 class="fw-title">Subcribe</h5>
						<p>Subscribe your email to get the latest news and new offer also discount</p>
						<form class="footer-newslatter-form">
							<input type="text" placeholder="Email address">
							<button><i class="fa fa-send"></i></button>
						</form>
					</div>
				</div>
			</div>
			
		</div>
	</footer>

	<!-- Footer section end -->                               
	<!--====== Javascripts & Jquery ======-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/masonry.pkgd.min.js"></script>
	<script src="js/magnific-popup.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>