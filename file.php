<html>
<head>
<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Registration </title>
		<link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
		<script src="http://code.jquery.com/jquery.js"></script>	
		<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<style>
.error {color: red;}
.ff {border:2px solid black;}
</style>
</head>
<body>
<?php
$nameErr = $emailErr = $genderErr = $conErr = $passErr = "";
$name = $email = $gender = $con = $pass = $email1 = $pass1 = $con1= "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (empty($_POST["name"])) {
$nameErr = "Username is mandatory";
}
else{
$name = test_input($_POST["name"]);
}

if (empty($_POST["email"])) {
$emailErr = "Email is mandatory";
}
else{
$email1 = test_input($_POST["email"]);
if (!filter_var($email1, FILTER_VALIDATE_EMAIL)) {
$emailErr = "Email is invalid";
}
else
{
$email = test_input($_POST["email"]);
}
}

if (empty($_POST["con"])) {
$conErr = "Contact is mandatory";
}
else{
$con1 = test_input($_POST["con"]);
if (strlen($con1)<10) {
$conErr = "Contact is invalid";
}
else
	$con = test_input($_POST["con"]);
}

if (empty($_POST["gender"])) {
$genderErr = "Gender is mandatory";
}
else{
$gender = test_input($_POST["gender"]);
}

if (empty($_POST["pass"])) {
$passErr = "Password is mandatory";
}
else{
	$pass1 = test_input($_POST["pass"]);
if (strlen($pass1)<5) {
$passErr = "Password length must be 6 character long";
}
else
	$pass = test_input($_POST["pass"]);
}


if(	$name!="" && $email!="" && $con!="" && $gender!="" && $pass!="")
{
	
	
	include 'db_connnection.php';
		$conn = OpenCon();
		if (isset($_POST['submit'])){
			
			
			echo "<div class=\"container\" ";
			$sql = "CREATE TABLE `ca2`.`students` ( `Id` INT NOT NULL AUTO_INCREMENT , `user_Name` VARCHAR(50) NOT NULL ,`password` VARCHAR(50) NOT NULL,`contact` INT NOT NULL , `gender` VARCHAR(50) NOT NULL , `email` VARCHAR(50) NOT NULL , PRIMARY KEY (`Id`)) ENGINE = InnoDB;";

			if ($conn->query($sql) === TRUE) {
				echo "Table details created successfully" ;
				echo "<br>";
			}

			$sql="insert into students (user_Name,password,contact,gender,email) values ('$name','$pass','$con','$gender','$email')";	
			$query=mysqli_query($conn,$sql);
			if($query){
				 set_time_limit(3);
				echo 'data inserted';
				 header("Location:Welcome.php");
session_start();
$_SESSION['name'] = $name;		
		echo "<br>";
			}
			else
			{
				echo 'Not Inserted';
				echo "<br>"; 
				echo  $conn->error;
			}
		}	
				
		
	echo "</div>";
		CloseCon($conn);

}

}
function test_input($data) {
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}
?>
<br><br>
<center>

<div id="div" class="container">	
<h2>Registration Form</h2>
<form method = "post" action = "">
<table class="table">
<tr>
<td>Userame:</td>

<td><input class="form-control" type = "text" name = "name">
</td>
<td><span class = "error">* <?php echo $nameErr;?></span>
</td>

</tr>
<tr>
<td>E-mail: </td>
<td><input class="form-control" type = "text" name = "email">
</td>
<td><span class = "error">* <?php echo $emailErr;?></span>
</td>
</tr>
<tr>
<td>Contact:</td>
<td> <input class="form-control" type = "text" name = "con">
</td>
<td><span class = "error">* <?php echo $conErr;?></span>
</td>
</tr>
<tr>
<td>Gender:</td>
<td>
<input type = "radio" name = "gender" value = "female"> Female
<input type = "radio" name = "gender" value = "male"> Male
</td>
<td><span class = "error">* <?php echo $genderErr;?></span>
</td>
</tr>
<tr>
<td>Password:</td>
<td> <input class="form-control" type = "password" name = "pass">
</td>
<td><span class = "error">* <?php echo $passErr;?></span>
</td>
</tr>
<td>
<input class="btn btn-info" type = "submit" name = "submit" value = "Submit">
<input class="btn btn-danger" type = "reset" name = "reset" value = "Reset">
</td>
</table>
</form>
</div>
</center>
</body>
</html>
