<?php
session_start();
include("conn.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {// && hash_equals($_SESSION['token'], $_POST['token']) && ($_SESSION['userid']==$_POST['id'])) {
    $username = "rin"; //$_SESSION['username'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $timezone = date_default_timezone_set("Asia/Ho_Chi_Minh");
    $timepost= date("d-m-Y h:i:s");

    $sql_command = "INSERT INTO post (username, title, content, timepost) VALUES ('$username', '$title', '$content', '$timepost')";
    if ($conn->query($sql_command) == TRUE) {
        header("location: profile.php");
    } else { $_SESSION['msg'] = $conn->error;}
    mysqli_close($conn);
}
?>