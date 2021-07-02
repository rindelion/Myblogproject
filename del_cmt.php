<?php
	session_start();
	include('conn.php');

	if (isset($_POST['idcomment']) && hash_equals($_SESSION['token'], $_POST['token']) && ($_SESSION['userid']==$_POST['id'])){

		$username = $_SESSION['username'];
		$idpost = $_SESSION['idpost'];
		$idcomment = $_POST['idcomment'];

		$query=mysqli_query($conn,"select * from comments where username='$username'");
		
		$row=mysqli_fetch_array($query);

		if ($username == $row['username']){
			$sql = "delete from comments where idcomment='$idcomment'";
			if ($conn->query($sql) === TRUE) {
				header("location:readmorepost.php?id=".$idpost);
			} else {
				echo "Error: " . $conn->error;
			}
		}
		else {
			$_SESSION['message']="You can only delete your comments.";
			header("location:readmorepost.php?id=".$idpost);
		}

	} else {
		header("location:readmorepost.php?id=".$idpost);
	}

	mysqli_close($conn);
?>