<?php
if(isset($_GET['search']))
              {
                echo ("success");
                $search = $_POST['search'];
                echo $search;
              }
else echo("fail");
?>
