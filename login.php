<?php
/*******************************************/

//LOGIN HANDLE

/*******************************************/

//message variable for login errors
$msg = '';

// if username and password isn't empty after submit, run code
if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {

	//grab form values and assign to variables
	$username = $_POST['username'];
	$username = strtolower($username);
	$username = stripslashes($username);
	$username = mysqli_real_escape_string($conn, $username);
	$password = $_POST['password'];
	$password = md5($password);	
	$password = stripslashes($password);
	$password = mysqli_real_escape_string($conn, $password);	

	//login SQL query execution
	$sql_login = "SELECT * FROM users WHERE username='$username' AND password='$password'";
	$query_login = mysqli_query($conn, $sql_login);
	$rows_login = mysqli_num_rows($query_login);
	$row = mysqli_fetch_assoc($query_login);

	//if login SQL query returns only one result, establish session variables
	if($rows_login == 1){

		$_SESSION['valid'] = true;
		$_SESSION['timeout'] = time();
		$_SESSION['id'] = $row['id'];
		$_SESSION['username'] = $row['username'];
		$_SESSION['password'] = $row['password'];	

		echo "You have entered valid use name and password!";
		header("Refresh: 1; url=index.php");

	} elseif ($rows_login == 0) {

		echo "Login denied. Invalid login credentials.";

	} else {

		echo "Error: Query error.";
	}	
}

/*******************************************/

//REGISTRATION HANDLE

/*******************************************/

//variable to store errors
$error='';
//check if the username or password field is empty, if so, give error
if(isset($_POST['register'])) {
	//if no fields are empty, run code
	if (!empty($_POST['reguser']) || !empty($_POST['regpass']) || !empty($_POST['regpassConfirm'])) {
		//checking to see if username already exists
		$sql_check = "SELECT username FROM users WHERE username='$_POST[reguser]'";
		$query_check = mysqli_query($conn, $sql_check);
		$results_check = mysqli_num_rows($query_check);
		//if user does exist, display error, if not, continue with registration processing
		if($results_check == 0){

			//if the two passwords match, continue registration processing
			if ($_POST['regpass'] == $_POST['regpassConfirm']) {

				//define username and passowrd according to what user entered on form
				$userName = $_POST['reguser'];
				$userPassword = $_POST['regpass'];	
				//convert username to all lowercase
				$userName = strtolower($userName);			

				//to protect mySQL injection for Security purposes
				$userName = stripslashes($userName);
				$userName = mysqli_real_escape_string($conn, $userName);	
				$userPassword = md5($userPassword);	
				$userPassword = stripslashes($userPassword);
				$userPassword = mysqli_real_escape_string($conn, $userPassword);

				//registration SQL query execution
				$sql_register = "INSERT INTO users (username, password) VALUES ('$userName', '$userPassword')";
				$query_register = mysqli_query($conn, $sql_register);

				if ($query_register) {
				    echo "Your form has been successfully submitted!";
				} else {
				    echo "Error updating record: " . mysqli_error($conn);
				}

				mysqli_close($conn);

			} else {

				echo "Uh oh! Your passwords didn't match. Try again.";

			};			

		} elseif ($results_check > 0) {

			echo "Uh oh! That username already exists. Try a different username.";

		} else {

			echo "Uh oh! Something went wrong with the query!";

		}
	} else {

		echo "Uh oh! Please fill out all fields of the form before submitting.";

	}
}

?>


<header>

To Do List

</header>

<div class="container">
	
	<!-- LOGIN FORM -->

	<form name="loginForm" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

		<input type="text" name="username" placeholder="Username" required /><br>
		<input type="password" name="password" placeholder="Password" required /><br><br>

		<input type="submit" name="login" value="Login" />
	</form><br>

	<hr><br>

	<!-- REGISTRATION FORM -->

	<form name="registerForm" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

	<input type="text" name="reguser" placeholder="Username" required /><br>
	<input type="password" name="regpass" placeholder="Password" required /><br>
	<input type="password" name="regpassConfirm" placeholder="Confirm Password" required /><br><br>

	<input type="submit" name="register" value="Sign Up!" />

</div>