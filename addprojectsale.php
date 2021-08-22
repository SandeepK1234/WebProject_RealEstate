<?php
    include('indexDB.php');
    session_start();
    $loc=$city=$desc=$am=$ar=$i=$i1=$i2=$i3=$rate='';$cost=0;
    $locErr=$cityErr=$descErr=$amErr=$arErr=$iErr=$costErr=$rateErr='';
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
$b=true;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["loc"])) {
        $locErr = "*Location is required";
        $b=false;
      } else {
        $loc = test_input($_POST["loc"]);
         if (!preg_match("/^[a-zA-Z_ ]*$/",$loc) || $loc=='') {
          $locErr = "*Only letters allowed";
          $b=false; 
        }
      }
      if (empty($_POST["city"])) {
        $cityErr = "*City is required";
        $b=false;
      } else {
        $city = test_input($_POST["city"]);
         if (!preg_match("/^[a-zA-Z]*$/",$city) || $city=='') {
          $cityErr = "*Only letters allowed";
          $b=false; 
        }
      }
      if (empty($_POST["desc"])) {
        $descErr = "*Description is required";
        $b=false;
      } else {
        $desc = test_input($_POST["desc"]);
      }
      if (empty($_POST["amen"])) {
        $amErr = "*Amenities is required";
        $b=false;
      } else {
        $am = test_input($_POST["amen"]);
      }
      if (empty($_POST["img1"])) {
        $iErr = "*Image is required";
        $b=false;
      } else {
        $i = test_input($_POST["img1"]);
        $i1= test_input($_POST["img2"]);
        $i2= test_input($_POST["img3"]);
        $i3= test_input($_POST["img4"]);
      }
  if (empty($_POST["area"])) {
    $arErr = "*Area is required";
    $b=false;
  } else {
    $ar = test_input($_POST["area"]);
    if(!preg_match("/^[0-9]{1,10}$/",$ar) || $ar==''){
    	$arErr = "*Enter only Numbers";
    	$b=false;
    }
  }
  if (empty($_POST["rate"])) {
		$rateErr = "*Rate is required";
    $b=false;
  } else {
		$rate = test_input($_POST["rate"]);
		if(!preg_match("/^[0-9]{1,10}$/",$rate) || $rate==''){
    	$rateErr = "*Enter only Numbers";
    	$b=false;
    }
	}
}
if($b==true && isset($_POST['submit']))
{
		$id='';
		if($_SESSION['type']=='normal')
		{
			$id='uid';
		}
		else
		{
			$id='bid';
		}
    $q1="insert into flat(location,".$id.",city,description,amenities,area,image,image1,image2,image3) values('$loc',".$_SESSION['id'].",'$city','$desc','$am',$ar,'$i','$i1','$i2','$i3')";
		$result1 = $conn->query($q1);
		echo $q1;
    echo "Insert in flat done";
    $q3="select flat_id from flat where location='$loc' and city='$city' and area=$ar and amenities='$am'";
    $r3=$conn->query($q3);
    $x=mysqli_fetch_array($r3, MYSQLI_ASSOC);
    $test=$x['flat_id'];
    echo "flat id fetched is ".$test;
    $cost=$rate*$ar;
		$q2="insert into sale(flat_id,totalcost,rate) values($test,$cost,$rate)";
		echo $q2;
    $result2 = $conn->query($q2);
    echo "Sale inserted";
    if($_SESSION['type']=='normal')
		{
			header('Location: normalHomeSale.php');
		}
		else
		{
			header('Location: builderHome.php');
		}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>real estate</title>
	<meta charset="UTF-8">
	<meta name="description" content="HOUSING-CO">
	<meta name="keywords" content="HOUSING-CO, unica, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

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
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>
	
	<!-- Header section -->
	<header class="header-section">
		<div class="header-top">
			<div class="container">
				<div class="row">
                    <div class="col-10">
                        
                    </div>
					<div class="col-2">
					<?php echo $_SESSION['username']."  ";?><a href="logout.php"><i class="fa fa-user-circle-o"></i>Logout</a>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="site-navbar">
<!--						<a href="index.html" class="site-logo"><img src="img/logo1.png" alt=""></a>-->
						<div class="nav-switch">
							<i class="fa fa-bars"></i>
						</div>
						<ul class="main-menu">
							<?php
							    if($_SESSION['type']=='builder')
                            {
                                echo "<li><a href='builderHome.php'>Home</a></li>";
                            }
                            else
                            {
                                echo "<li><a href='normalHomeSale.php'>Home</a></li>";
                            }
                            ?>
							<?php 
							if($_SESSION['type']=='normal')
							{
								echo "<li><a href='normalHomeSale.php'>View property</a></li>";
							}
							else
							{
//								echo "<li><a href='builderHome.php'>View property</a></li>";
							}
							?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</header>
	<!-- Header section end -->
	<section class="hero-section set-bg" data-setbg="img/san.jpg">
		<div class="container hero-text text-white">
			<h2>List your building on our website for Sale</h2>
		</div>
	</section>
	<br><br><br>
    <!-- Properties section end -->
    <style type="text/css">
body{
background-repeat:no-repeat;
background-image:url("img/san.jpg");
background-size:cover;
background-attachment:fixed;
color:white;
}
input[type=text],input[type=date],input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
    background-color: #e0e0d1;
    color:black;
}

 input[type=submit], input[type=reset] {
    background-color: #e0e0d1;
    border: none;
    color: black;
    padding: 16px 32px;
    text-decoration: none;
    margin: 4px 2px;
    cursor: pointer;
    font-weight:bold;
}
input[type=radio] {
    height: 15px;
    width: 15px;
    
}



select {
	 background-color: #e0e0d1;
    border: none;
    color: black;
    padding: 16px 32px;
    text-decoration: none;
    margin: 4px 2px;
    cursor: pointer;
    font-weight:bold;
}
textarea {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
    background-color:#e0e0d1;
    color:black;
}
table{
 background-color:black;
  border-collapse: collapse; 
  border: 2px solid navy;
}
form{
opacity:0.7;
}
td{
font-weight:bold;
}
span
{
   color:red;
}

</style>
</head>




<form id="form" method="post" action="addprojectsale.php" >

<table cellpadding="7" width="50%" border="0" align="center"cellspacing="2" color="white">

    <!-- I want another button here, center to the tile-->

<tr>
<td colspan=2>
<center><font size=5><b>ADD PROPERTIES</b></font></center>
</td>
</tr>

<tr>
<td><b>Location:</b></td>
<td><input type="text" name="loc" size="30">
<span class="error"><?php echo $locErr; ?></span>
<br><br>
</td>
</tr>




<tr>
<td><b>City:</b></td>
<td><input type="text" name="city" size="30">
<span class="error"><?php echo $cityErr; ?></span>
  <br><br>
</td>
</tr>


<tr>
<td><b>Description:</b></td>
<td><input type="text" name="desc" size="30">
<span class="error"><?php echo $descErr; ?></span>
  <br><br>
</td>
</tr>


<tr>
<td><b>Amenities:</b></td>
<td><input type="text" name="amen" size="30">
<span class="error"><?php echo $amErr; ?></span>
  <br><br>
</td>
</tr>


<tr>
<td><b>Area:</b></td>
<td><input type="text" name="area" size="30">
<span class="error"><?php echo $arErr; ?></span>
  <br><br>
</td>
</tr>

<tr>
<td><b>Image1 URL:</b></td>
<td><input type="text" name="img1" size="30">
<span class="error"><?php echo $iErr; ?></span>
  <br><br>
</td>
</tr>
<tr>
<td><b>Image2 URL:</b></td>
<td><input type="text" name="img2" size="30">
<span class="error"></span>
  <br><br>
</td>
</tr>
<tr>
<td><b>Image3 URL:</b></td>
<td><input type="text" name="img3" size="30">
<span class="error"></span>
  <br><br>
</td>
</tr>
<tr>
<td><b>Image4 URL:</b></td>
<td><input type="text" name="img4" size="30">
<span class="error"></span>
  <br><br>
</td>
</tr>
<tr>
<td><b>Rate per sq ft:</b></td>
<td><input type="text" name="rate" size="30">
<span class="error"><?php echo $rateErr;?></span>
  <br><br>
</td>
</tr>
<tr>
<td><input type="reset" value="Reset"></td>
<td><input type="submit" value="Submit" name="submit">

<div style = "font-size:20px; color:#cc0000; margin-top:10px"></div>
</td>
</tr>
</table>
<br><br><br><br><br><br><br><br><br><br>
</form>

                                        
	<!--====== Javascripts & Jquery ======-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/masonry.pkgd.min.js"></script>
	<script src="js/magnific-popup.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>