<?php
session_start();
include_once 'classes.php';
include_once 'connection.php';

if(isset($_SESSION['username']))
{
  header('Location:userhome.php');
}

if(isset($_POST['submit'])){
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $msg = $_POST['msg'];
    $viewer = new Viewer($conn);
    if($name && $email){
      $result = $viewer->contact_us($name,$email,$msg);
      if ($result==true){
          echo "<script type='text/javascript'>alert('Thank You for choosing us!!!');window.location.href = 'contactUs.php';</script>";
      }
      else{
          echo "<script type='text/javascript'>alert('Something went wrong:(');window.location.href = 'contactUs.php';</script>";
      }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>ContactUs</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css">

  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
  <!--Import Google Icon Font-->
      <link href='https://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<!--      Import materialize.css
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <script src="/materialize/css/materialize.min.css"></script>-->
      <script type="text/javascript">
        $(document ).ready(function(){
     $(".button-collapse").sideNav();
  })
  </script> 
</head>
<body style="font-family:'Lora',serif;">
  

  <div class="navbar-fixed ">
  <nav>
    <div class="nav-wrapper blue-grey">
      <a href="#!" class="brand-logo" style="text-decoration:none">Channel</a>
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
      <li><a href="index.php" class="btn waves-effect waves-light deep-orange lighten-2" style="padding-right:2em;text-decoration:none">Home</a></li>    
      <li><a href="signup.php" class="btn waves-effect waves-light deep-orange lighten-2" style="padding-right:2em;text-decoration:none">Sign Up</a></li>
      <li><a href="login.php" class="btn waves-effect waves-light deep-orange lighten-2" style="padding-right:2em;text-decoration:none">Login</a></li>
      </ul>
       <ul class="side-nav" id="mobile-demo">
         <li><a href="signup.php" style="text-decoration:none">Sign Up</a></li>
      <li><a href="login.php"  style="text-decoration:none">Login</a></li>
      </div>
      </nav>
      </div>
    <h3 class="text-center">Contact Us...</h3>
    <div class="row col s12">
            <form class="col s12" method="post">
                <div class="row">
                    <div class="input-field col s9">
                        <input id="name" type="text" class="validate" name="name" autofocus required>
                        <label for="name">Name</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s9">
                        <input id="email" name="email" type="email" class="validate" required>
                        <label for="pwd">Email</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s9">
                        <input id="msg" type="text" class="validate" name="msg" autofocus>
                        <label for="msg">Message</label>
                    </div>
                </div>
                <button class="btn waves-effect waves-light" type="submit" name="submit">Submit<i class="material-icons right">send</i>
                </button>
            </form>
        </div>
</body>
</html>