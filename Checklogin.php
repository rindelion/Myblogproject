<?php
   session_start();
   //Change these configs according to your MySQL server
   $servername = "localhost";
   $username = "root";
   $password = "1234";
   $database = "myblog"; 		 
   $table = "users";

   $conn = mysqli_connect($servername, $username, $password, $database);
	#mysqli_set_charset('utf8', $conn);
		// Check connection
		if ($conn->connect_error) {
			$_SESSION['msg'] = "Connection failed";
            echo ("successfull");
		    //die("Connection failed: " . $conn->connect_error);
		}
		else{
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
			// 2 ways to get fields in form, the later is more secure
			$name = $_POST['username'];
			$password = $_POST['password'];
			}
			// $name = mysqli_real_escape_string($conn, $_POST['name']);
			
			//Create SQL command to insert data to database
			$sql_command = "SELECT * FROM $table WHERE username = '.$username.' AND password = '.$password.'";

         $result = mysqli_query($conn, $sql_command);
         if (mysqli_num_rows($result) > 0) {
            echo ("successfull!");
            header('location:http://localhost:9090/myblogproject/Blog.php');
				
         }
			else
				$_SESSION['msg'] = $conn->error;

			mysqli_close($conn);
		}
?>