<?php
include('indexDB.php');
session_start();

if(isset($_POST['username']))
{
    $uname =$_POST['username'];
}
$fid=$_SESSION["flat_id"];
$bname=$_SESSION["buyer"];
$s1 = "SELECT uid,bid FROM flat  where flat_id=$fid";
$result = $conn->query($s1);
$row = mysqli_fetch_assoc($result);
if($row['bid']==NULL)
{
    $j=$row['uid'];
}
else
{
    $j=$row['bid'];
}
$Bname= $_POST['Bankname'];
$amount= $_SESSION['amt'];
$loandetails=$_POST['Loandetails'];
$cnum= $_POST['Chequenumber'];
$popt= $_POST['Paymentoption'];
echo $popt;
$sql = "INSERT INTO payment (UID,buyer,Bank_name,amount,Loan_details,cheque_number,payment_opt) VALUES ($j,'$bname','$Bname',$amount,'$loandetails',$cnum,'$popt')";
if(mysqli_query($conn, $sql)){
    echo '<script src= 
    "https://smtpjs.com/v3/smtp.js"> 
  </script>';
    echo' <script type="text/javascript"> 
         alert("Site Booked Sucessfully");
            Email.send({ 
              Host: "smtp.gmail.com", 
              Username: "17CS093.Sandeep@sjec.ac.in", 
              Password: "1234SJEC##", 
              To: "sandeepperuvai@gmail.com", 
              From: "17CS093.Sandeep@sjec.ac.in", 
              Subject: "Realestate", 
              Body: "Thank you for Booking", 
            }) 
              .then(function (message) { 
                alert("mail sent successfully") ;
              }); 
          
          window.location.href="normalHomeSale.php"; 
  </script>';

} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}
mysqli_close($conn);
?>

