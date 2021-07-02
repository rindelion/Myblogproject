<?php
	session_start();
	//Change these configs according to your MySQL server
	$servername = "localhost";
	$username = "root";
	$password = "1234";
	$database = "myblog"; 		 
	$table = "users";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $database);
	#mysqli_set_charset('utf8', $conn);
		// Check connection
		if ($conn->connect_error) {
			$_SESSION['msg'] = "Connection failed";
		    //die("Connection failed: " . $conn->connect_error);
		}
		else{
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
			// 2 ways to get fields in form, the later is more secure
			$name = $_POST['name'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$hashed_password = password_hash($password, PASSWORD_DEFAULT);
			echo ($hashed_password);
			}
			// $name = mysqli_real_escape_string($conn, $_POST['name']);
			
			//Create SQL command to insert data to database
			$sql_command = "INSERT INTO $table (username, password,email, cookie) VALUES ('$name','$hashed_password','$email',null)";

			if ($conn->query($sql_command) === TRUE)
				// $_SESSION['msg'] = "New record created successfully";
				header("location: Blog.php");
			else
				$_SESSION['msg'] = $conn->error;

			mysqli_close($conn);
		}
?>