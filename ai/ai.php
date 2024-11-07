<?php 
 session_start();
 define('SITEURL','http://localhost/ai/ai.php');
 define('LOCALHOST','localhost');
 define('DB_USERNAME','root');
 define('DB_PASSWORD','');
 define('DB_NAME','ai');
 $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());
 $db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_error());
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport"content="width=device-width,initial-scale=1.0">
	<title>Proviz School of AI</title>
	<link rel="stylesheet" href="ai.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" >
</head>
<body>
	<div class="title">
		<?php
			if(isset($_SESSION['application']))  //  Checking whether the Session is set or not
			{
				echo $_SESSION['application'];   //  Display Session  Message if SET
				unset($_SESSION['application']);   //  Remove Session Message 
			}
		?>
		<h1>Proviz School of AI</h1>
		<p class="s">Step into the future of AI and Data Science with real-world skills and classroom experience.</p><br>
		<div>
			<h3 class="vision">Our Vision</h3>
			<br>
			<p class="p">At Proviz, we envision a world where every student has the support and opportunities they need to achieve their full potential, driving innovation and success in AI, ML, and Data Science</p>
		</div>
		<br><br>
		<button class="apply" onclick="togglePopup()">Apply Now</button>
		<div id="popupOverlay" 
			 class="overlay-container">
			<div class="popup-box">
				<h2 style="color: green;">Application Form</h2>
				<form class="form-container" action="" method="POST">
					<label class="form-label" for="name"><b>Name:</b></label>
					<input class="form-input" type="text" placeholder="Enter Your Name" id="name" name="name" required>
					<label class="form-label" for="name"><b>Phone No.:</b></label>
					<input class="form-input" type="tel" placeholder="Enter Your Phone No." id="phone" name="phone" required>	
					<label class="form-label" for="email"><b>Email Id:</b></label>
					<input class="form-input" type="email" placeholder="Enter Your Email Id" id="email" name="email" required>
					<label class="form-label" for="statement"><b>Brief Statement:</b></label>
					<textarea style="margin-right: 10px;" class="form-input" type="text" placeholder="Enter Your Statement" id="statement" name="statement" rows="10" cols="20" required></textarea>	
					<button class="btn-submit" name="submit" type="submit">Submit</button>
				</form>
				<button class="btn-close-popup" onclick="togglePopup()">Close</button>
			</div>
		</div>
		<script src="ai.js"></script>
</body>
</html>
<?php
	if(isset($_POST['submit']))
	{
		$name = mysqli_real_escape_string($conn,$_POST['name']);
		$phone_no = mysqli_real_escape_string($conn,$_POST['phone']);
		$email_id = mysqli_real_escape_string($conn,$_POST['email']);
		$statement = mysqli_real_escape_string($conn,$_POST['statement']);
		$sql = "INSERT INTO tbl_application SET
			name ='$name',
			phone_no = '$phone_no',
			email_id = '$email_id',
			statement = '$statement' 
		";
		$res = mysqli_query($conn, $sql);
		if($res==TRUE)
		{
			$_SESSION['application'] = "<div style='color:green;text-align:center;' class='success text-center'>Application Submitted Successfully.</div>";
			?>
			<meta http-equiv="refresh" content="0;url=ai.php"> 
			<?php
		}
		else
		{
			$_SESSION['application'] = "<div style='color:red;text-align:center;' class='error text-center'>Failed to submit Application.</div>";
			?>
			<meta http-equiv="refresh" content="0;url=ai.php"> 
			<?php
		}
	}
?>