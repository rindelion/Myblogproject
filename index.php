<?php
    function random_str(
      int $length = 64,
      string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
   ): string {
      if ($length < 1) {
          throw new \RangeException("Length must be a positive integer");
      }
      $pieces = [];
      $max = mb_strlen($keyspace, '8bit') - 1;
      for ($i = 0; $i < $length; ++$i) {
          $pieces []= $keyspace[random_int(0, $max)];
      }
      return implode('', $pieces);
   }	

   session_start();
   include('conn.php');

   if (isset($_POST['login'])){

     $username=$_POST['username'];
     $password=$_POST['password'];
     

     $query=mysqli_query($conn,"select * from user where username='$username' && password='$password'");
     
     
     if (mysqli_num_rows($query) == 0){
        $_SESSION['message']="Login Failed. User not Found!";
        header('location:index.php');
     }
     else {
         if(password_verify($password, $row['password'])){
            $row=mysqli_fetch_array($query);
         
         //set up cookie
         if (isset($_POST['remember'])){
            //set up cookie 
            setcookie("cookie", random_str(), time() + (86400 * 30));
         }

         $_SESSION['iduser']=$row['iduser'];
         $_SESSION['username']=$row['username'];
         header('location:blog.php');
         }
         else
         {
            $_SESSION['message']="Login Failed. User not Found!";
            header('location:index.php');
         }
         
     }
  }
  else{
     if (isset($_COOKIE['cookie'])){

        $cookie=$_COOKIE['cookie'];

        $query=mysqli_query($conn,"select * from user where cookie='$cookie'");
        $row=mysqli_fetch_array($query);

        $_SESSION['iduser']=$row['iduser'];
        $_SESSION['username']=$row['username'];
        header('location:blog.php');
     } else {
        header('location:index.php');
        $_SESSION['message']="Please Login!";
     }
  }

  mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>User Login</title>
</head>
<body>
   <div class="overlay">
   <!-- LOGN IN FORM by Omar Dsoky -->
   <form method="POST">
      <head>
            <link rel="stylesheet" type="text/css" href="Login.css">
            <script type="text/javascript" src="Login.js"></script>
      </head>
      <!--   con = Container  for items in the form-->
      <div class="con">
      <!--     Start  header Content  -->
      <header class="head-form">
         <h2>Log In</h2>
         <!--     A welcome message or an explanation of the login form -->
         <p>login here using your username and password</p>
      </header>
      <!--     End  header Content  -->
      <br>
      <div class="field-set">
         
         <!--   user name -->
            <span class="input-item">
               <i class="fa fa-user-circle"></i>
            </span>
            <!--   user name Input-->
            <input class="form-input" id="username" type="text" placeholder="Username"value="
               <?php if (isset($_COOKIE["user"])){echo $_COOKIE["user"];}?>" name="username"
               required>
         
         <br>
         
               <!--   Password -->
         
         <span class="input-item">
            <i class="fa fa-key"></i>
            </span>
         <!--   Password Input-->
         <input class="form-input" type="password" placeholder="Password" id="password"  name="password" value="
            <?php if (isset($_COOKIE["pass"])){echo $_COOKIE["pass"];}?>" name="password"
            required>
         
   <!--      Show/hide password  -->
          <span>
            <i class="fa fa-eye" aria-hidden="true"  type="button" id="eye"></i>
         </span> 
         
         
         <br>
   <!--        buttons -->
   <!--      button LogIn -->
         <button  class="log-in"> Log In </button>

         <!-- <span class = "input-item">
            <div class = "login-form"></div>
         </span> -->
   </div>
      
   <!--   other buttons -->
      <div class="other">
   <!--      Forgot Password button-->
         <button class="btn submits frgt-pass">Forgot Password?</button>
   <!--     Sign Up button -->
         <a href="http://localhost:9090/myblogproject/Signup.html" >
            <button href="http://localhost:9090/myblogproject/Signup.html" class="btn submits sign-up" type="button">Sign Up          
   <!--         Sign Up font icon -->
         <i class="fa fa-user-plus" aria-hidden="true"></i>
         </button>
         </a>
   <!--      End Other the Division -->
      </div>
         
   <!--   End Conrainer  -->
      </div>
      
      <script>        
         //Kiểm tra username password được nhập không
         function Checknull()
         {
            var user = document.getElementById("username").value;
            var pwd = document.getElementById("password").value;
            if (user=="" || pwd=="") {
               alert ("Username và password không được bỏ trống!");
               return false;
            }
            else return true;
         }
         function CheckLength()
         {
            var pwd = document.getElementById("password").value;
            if (pwd.length<8)
            {
               alert ("Password có tối thiểu 8 kí tự.")
               return false;
            }
            return true;
         }
      </script>
      <!-- End Form -->
   </form>
   </div>
   <?php
        if (isset($_SESSION['message'])){
            echo $_SESSION['message'];
        }
        unset($_SESSION['message']);
    ?>
</body>
</html>