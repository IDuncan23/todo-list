<?php
session_start();
session_destroy();
//once session is destroyed, browser will be redirected to index.php
header("Refresh: 3; url=/web-dev/projects/to-do-list/index.php"); /* Redirect browser */


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
		<header>
			<?php echo "You have successfully logged out. Redirecting to home page...";?>
		</header>

		<!-- Javascripts -->
		<script src="resources/js/main.js"></script>

<?php mysqli_close($conn); ?>

</body>
</hmtl>