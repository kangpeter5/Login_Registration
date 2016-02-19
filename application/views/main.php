<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	// var_dump($this->session->flashdata('registration_error')); die();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login and Registration</title>

	<link rel="stylesheet" type="text/css" href="assets/style.css">
</head>
<body>

<div id="container">
	<div class="boxes">
		<h3>Login</h3>
<?php
		if($this->session->flashdata("login_error")) 
  		{
    		echo "<p> " . $this->session->flashdata("login_error") . "</p>";
  		}
?>		
		<form action="/users/login" method="post">
			<label>Email: </label><input type="text" name="email"/>
			<label>Password: </label><input type="password" name="password" />
			<input type="submit" value="Login" />
		</form>
	</div>

	<div class="boxes">
		<h3>Registration</h3>
<?php
		if($this->session->flashdata("registration_error")) 
  		{
    		echo  "<p> " . $this->session->flashdata("registration_error") . "</p>";
  		}
?>
		<form action="/users/register" method="post">
			<label>First Name: <label><input type="text" name="first_name"  >
			<label>Last Name: <label><input type="text" name="last_name" >
			<label>Email: <label><input type="text" name="email"  />
			<label>Password: <label><input type="password" name="password" />
			<label>Confirm Password: <label><input type="password" name="confirm_password" />
			<input type="submit" value="Register" />
		</form>
	</div>
		
	</div>

</div>

</body>
</html>