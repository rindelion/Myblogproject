<?php
	session_start();
	include('conn.php');

	if (isset($_POST['post']) && hash_equals($_SESSION['token'], $_POST['token']) && ($_SESSION['userid']==$_POST['id'])){

		$username = $_SESSION['username'];
		$idpost = $_SESSION['idpost'];
		$comment = $_POST['comment'];

		$comment = str_replace("'","%27",$comment);
		$comment = str_replace('"','%22',$comment);

		$sql = "insert into comments (username, idpost, content) values ('$username', '$idpost', '$comment')";

		if ($comment != "") {
			if ($conn->query($sql) === TRUE) {
				header("location:readmorepost.php?id=".$idpost);
			} else {
				echo "Error: " . $conn->error;
			}
		}
		else {
			header("location:readmorepost.php?id=".$idpost);
		}

	} else {
		header("location:readmorepost.php?id=".$idpost);
	}

	mysqli_close($conn);
?>