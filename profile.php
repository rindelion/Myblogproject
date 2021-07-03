<?php 
	session_start();

    if (isset($_SESSION['iduser']))
    {
        $userid = $_SESSION['iduser'];
        include('conn.php');
    
        $sql_command = "SELECT iduser, username, email, bio, avatar FROM user WHERE iduser=$userid";
        $result = mysqli_query($conn, $sql_command);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $username = $row["username"];
                $email = $row["email"];
                $bio = $row["bio"];
                $avatar = base64_encode($row["avatar"]);
                //$avatar = $row['avatar'];
            }
            mysqli_close($conn);
        }
    }
    else echo 'Error';
?>

<!DOCTYPE html>
<html lang="eng">

    <head>

      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
  
      <title>Profile</title>
  
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

      <link href="css/profile-template.css" rel="stylesheet">
  
      <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
      <!--  All snippets are MIT license http://bootdey.com/license -->
      <script type="text/javascript" src="https://ff.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=wV1EdEBOyHJxPgEwO2q5cKQm7FADbNjQf5JTSceyiICeZdwqDfPUT1GzpyFn8xuHfy7bjTkiGvpPwHdTsKgrPpy1PSJWNkrTFvjd154qsPViD4lQ0pMFKt7jiwAmmj2ubRfVtfp8nEDaVLbNKAW9yw" charset="UTF-8"></script><script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
      <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
      <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
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
            <a class="navbar-brand" href="Blog.php">Simple Blog</a>
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
              <li>
                <a href="about.html">About</a>
              </li>
              <li> 
                  <a href="profile.php">Profile</a>
              </li>
              <li>
                <a href="index.php">Logout</a>
              </li>
            </ul>
          </div>
          <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
      </nav>

      <div class="container"> 
        <div class="col-md-12">  
          <div class="col-md-4">      
            <div class="portlet light profile-sidebar-portlet bordered">
              <div class="profile-userpic">
                  <?php
                    if ($avatar==="NULL") echo '<img 
                    src="https://cdn.shopify.com/s/files/1/0262/9228/9641/t/10/assets/pf-a6beb393--03usagyuuuncharacter01_400x3000.png?v=1597831326" 
                    class="img-responsive" alt="">';
                    else echo '<img src="data:image/png;base64'. $avatar.'" class="card-img-top" alt="">';
                  ?>
                 </div>
              <div class="profile-usertitle">
                <div class="profile-usertitle-name"> <!-- Username -->
                  <?php 
                    echo $username;
                  ?> 
                </div> 
                <div class="profile-usertitle-job"> Reviewer </div>
              </div>
              <div class="profile-userinfo"> 
                <ul class="nav">
                  <li class="active"> <!-- Biography of user -->
                    <a href="#">
                    <i class="profile-userinfo-bio"></i> 
                    <?php 
                        echo $bio;
                    ?>
                    </a>
                  </li>
                  <li> <!-- User's email -->
                    <a href="#">
                    <i class="profile-userinfo-email"></i> 
                        <?php 
                            echo $email;
                        ?> </a> 
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-8"> 
            <div class="portlet light bordered">
              <div class="portlet-title tabbable-line">
                <div class="caption caption-md">
                  <i class="icon-globe theme-font hide"></i>
                  <span class="caption-subject font-blue-madison bold uppercase">PROFILE</span>
                </div>
              </div>
              <div class="portlet-body">
                <div>
                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#edit" aria-controls="edit" role="tab" data-toggle="tab">Edit</a></li>
                    <li role="presentation"><a href="#blogs" aria-controls="blogs" role="tab" data-toggle="tab">Blogs</a></li>
                    <li role="presentation"><a href="#newpost" aria-controls="newpost" role="tab" data-toggle="tab">NewPost</a></li>
                  </ul>
                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="edit">
                      <form id="edit" action="updateprofile.php" method="POST">
                        <div class="form-group">
                          <label for="InputEmail">Email address</label>
                          <input type="email" class="form-control" id="InputEmail" name="InputEmail" placeholder="Email" maxlenth="30" value="<?php echo $email ?>">
                        </div>
                        <div class="form-group">
                          <label for="CurrentPassword">Current Password</label>
                          <input type="password" class="form-control" id="CurrentPassword" name="CurrentPassword" placeholder="Password" minlength="8"
                                 pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,}$" 
                                 title="Password must be from 8 to 12 characters, includes uppercases, lowercases, numbers and special characters:!@#$%^&*_=+-">
                        </div>
                        <div class="form-group">
                          <label for="InputPassword">Password</label>
                          <input type="password" class="form-control" id="InputPassword" name="InputPassword" placeholder="Password" minlength="8"
                                 pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,}$" 
                                 title="Password must be from 8 to 12 characters, includes uppercases, lowercases, numbers and special characters:!@#$%^&*_=+-">
                        </div>
                        <div class="form-group">
                          <label for="InputBio">Biography</label>
                          <input type="text" class="form-control" id="InputBio" name="InputBio" placeholder="Speak yourself!" maxlength="100" value="<?php echo $bio ?>">
                        </div>
                        <div class="form-group">
                          <label for="InputFile">File input</label>
                          <input type="file" id="InputFile" name="InputFile" onchange=fileValidation()>
                          <p class="help-block">Only accepted .jpg, .jpeg and .png, maximum 5MB.</p>
                        </div>
                        <button type="submit" class="btn btn-default" onclick=CheckPass()>Submit</button>
                      </form>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="blogs">
                        <?php 
                            //$sql_command_blog = "SELECT * FROM blog, user WHERE blog.iduser=2 AND blog.iduser=user.iduser";
                            $sql_command_blog = "SELECT * FROM post WHERE username='$username'";
                            include ("conn.php");
                            $result_blog = mysqli_query($conn, $sql_command_blog);
                            if (mysqli_num_rows($result_blog) > 0) {
                                // output data of each row
                                while($value = mysqli_fetch_assoc($result_blog)) {
                                    $idpost = $value["idpost"];
                                    $title = $value["title"];
                                    $blog_username = $value["username"];
                                    $timepost = $value["timepost"];
                                    $content = $value["content"];
        
                                    echo '<!-- First Blog Post -->
                                    <h2 class="post-title">
                                    <a href="post.html">'.$title.'</a>
                                    </h2>
                                    <p class="lead">
                                    by '.$blog_username.'
                                    </p>
                                    <p><span class="glyphicon glyphicon-time"></span>'.$timepost.'</p>
                                    <p>'.$content.'</p>
                                    <a class="btn btn-default" href="readmorepost.php?id='.$idpost.'">Read More</a>
                                    <hr>';
                                }
                                mysqli_close($conn);
                            } else {
                                echo "0 results";
                            }
                        ?>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="newpost">
                      <!-- Newpost form -->
                      <form action="newpost.php" method="POST" class="newpost-form">
                        <div class="form-group">
                          <label for="title">Title</label>
                          <input type="text" id="title" name="title" class="form-control" required>
                        </div>

                        <div class="form-group">
                          <label for="content">Content</label>
                          <textarea rows="5" id="content" name="content" class="form-control"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Post</button>

                      </form>
                      <!-- /form -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <script>
        function fileValidation() {
          var fileInput = document.getElementById('InputFile');
          var filePath = fileInput.value;
          // Allowing file type
          var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
          if (!allowedExtensions.exec(filePath)) {
            alert('Invalid file type!');
            fileInput.value = '';
            return false;}
          else {
            // Image preview
            if (fileInput.files && fileInput.files[0]) {
              var reader = new FileReader();
              reader.onload = function(e) {
                document.getElementById('imagePreview').innerHTML = '<img src="' + e.target.result+ '"/>';
              };  
              reader.readAsDataURL(fileInput.files[0]);
            }
          }
        }

        function CheckPass(){
            var curpass = document.getElementsByName('CurrentPassword');
            var newpass = document.getElementsByName('InputPassword');
            if (!empty(newpass) && curpass !== newpass) {
                if (confirm('Your current password and password are different. Do you want to change your current password to new password?')){
                    return true;
                } else return false;
            }
        }
      </script>

    </body>
</html>