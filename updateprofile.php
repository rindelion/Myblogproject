<?php 
session_start();
include("conn.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") { //&& hash_equals($_SESSION['token'], $_POST['token']) && ($_SESSION['userid']==$_POST['id'])) {
    $username = "rin"; //$_SESSION['username'];
    $email = $_POST['InputEmail'];
    $currpass = $_POST['CurrentPassword'];
    $password = $_POST['InputPassword'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $hashed_current = password_hash($currpass, PASSWORD_DEFAULT);
    $bio = $_POST['InputBio'];
    

    $sql_command = "SELECT * FROM user WHERE username='$username'";
    $result = mysqli_query($conn, $sql_command);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $pass = $row['password'];
            }
            mysqli_close($conn);
        }
    //if (hash_equals($pass, $currpass))
    if ($currpass === $pass)
    {
        $sql_command = "UPDATE user SET email='$email', bio='$bio'";
        if (!empty($_POST['InputPassword']) && !hash_equals($currpass, $password)) {
            $sql_command = $sql_command.",password='$password'"; //password='$hashed_password'"
        }
        if (!empty($_POST['InputFile']))  {
            $avatar = $_POST['InputFile'];
            $sql_command = $sql_command.",avatar='$avatar'";
        }

        $sql_command = $sql_command." WHERE username='$username'";

        include("conn.php");
        if ($conn->query($sql_command) == TRUE) {
            header("location: profile.php");
        } else { $_SESSION['msg'] = $conn->error;}
        mysqli_close($conn);
    }
    else 
    {
        echo '<script>alert("Your password is not correct. Please try again.") </script>';
        //header("location: profile.php"); 
    }
}

?>