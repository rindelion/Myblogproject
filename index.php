<?php 
    //session_start();
    //Change these configs according to your MySQL server
    $servername = "localhost";
    $username = "root";
    $password = "1234";
    $database = "myblog";
    $table = "posts";
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Home - Simple Blog Template</title>
    
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/simple-blog-template.css" rel="stylesheet">
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html">Simple Blog</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <li>
              <a href="about.html">About</a>
            </li>
            <li>
              <a href="login.html">Login</a>
            </li>
            <li>
              <a href="signup.html">Sign up</a>
            </li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
      </div>
      <!-- /.container -->
    </nav>
    
    <!-- Search bar -->

    <form class="example" action="/action_page.php" style="margin:auto;max-width:300px">
      <input type="text" placeholder="Search.." name="search2">
      <button type="submit"><i class="fa fa-search"></i></button>
    </form>
    <!-- Page Content -->
    <div class="container">

      <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-12">
          
          <?php

          // Create connection
            $conn = mysqli_connect($servername, $username, $password, $database);
            // Check connection
            if ($conn->connect_error) {
              //$_SESSION['msg'] = "Connection failed";
                //die("Connection failed: " . $conn->connect_error);
                    echo "connection failed!";
            }
            else{
                  
              $sql_command = "SELECT * FROM posts";

              $result = mysqli_query($conn, $sql_command);
              if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while($row = mysqli_fetch_assoc($result)) {
                          $id = $row["idpost"];
                          $title = $row["title"];
                          $username = $row["username"];
                          $timepost = $row["timepost"];
                          $content = $row["content"];
                          $timepost = $row["timepost"];
                          $image = $row["image"];

                          echo '<!-- First Blog Post -->
                          <h2 class="post-title">
                            <a href="post.html">'.$title.'</a>
                          </h2>
                          <p class="lead">
                            by '.$username.'
                          </p>
                          <p><span class="glyphicon glyphicon-time"></span>'.$timepost.'</p>
                          <p>'.$content.'</p>
                          <a class="btn btn-default" href="http://localhost:9090/myblogproject/post.php?id='.$id.'">Read More</a>
                          <hr>';
                        }
                    } else {
                        echo "0 results";
                    }

              mysqli_close($conn);
            }
          
          
          ?>
          <!-- Pager -->
          <ul class="pager">
            <li class="previous">
              <a href="#">Prev</a>
            </li>
            <li class="next">
              <a href="#">Next</a>
            </li>
          </ul>

        </div>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <p>Copyright &copy; Your Website 2014</p>
          </div>
          <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
      </div>
    </footer>


    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

  </body>
          
<style>
body {
  font-family: Arial;
}

* {
  box-sizing: border-box;
}

form.example input[type=text] {
  padding: 10px;
  font-size: 17px;
  border: 1px solid grey;
  float: left;
  width: 80%;
  background: #f1f1f1;
}

form.example button {
  float: left;
  width: 20%;
  padding: 10px;
  background: #2196F3;
  color: white;
  font-size: 17px;
  border: 1px solid grey;
  border-left: none;
  cursor: pointer;
}

form.example button:hover {
  background: #0b7dda;
}

form.example::after {
  content: "";
  clear: both;
  display: table;
}
</style>
</html>
