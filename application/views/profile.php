<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>User Profile Page</title>

	<link rel="stylesheet" type="text/css" href="/assets/style.css">
</head>
<body>

<div id="container">
	<h3>Welcome <?= $user['first_name']; ?></h3>

	<h4>User</h4>
	<div class="boxes">
		<label>First Name: <label> <p><?= $user['first_name']; ?></p>
		<label>Last Name: <label> <p><?= $user['last_name']; ?></p>
		<label>Email Address: <label> <p><?= $user['email']; ?></p>
	</div>

	<a id="log_off" href="/users/logout">log off</a>

</div>

</body>
</html>