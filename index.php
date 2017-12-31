<?php 
include 'resources/php/core.inc.php';

//user validation and non user validation
$userValid = !empty($_SESSION['id']) && !empty($_SESSION['username']);

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<!-- SDD320 Final Project completed by Isaiah Duncan -->
		<title>To-Do List App</title>

		<!-- Stylesheets -->
		<link rel="stylesheet" type="text/css" href="resources/css/reset.min.css">
		<link rel="stylesheet" type="text/css" href="resources/css/style.css">
		<!-- Roboto font embed -->
		<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
	</head>
	<body>
		<?php
		//include database connection in order to process SQL queries
		include 'resources/php/db_connect.php';

		//if user is valid, show todo list; if not, show login/signup forms
		if ($userValid) {
			include 'todoList.html'; 
		} else if (!$userValid) {
			include 'login.php';
		} else {
			echo "Uh oh! Error displaying content. See index source code.";
		};

		?>

		<?php //close db connection
		include 'resources/php/db_close.php'; ?>

		<!-- Javascripts -->
		<script src="resources/js/main.js"></script>

	</body>
</html>