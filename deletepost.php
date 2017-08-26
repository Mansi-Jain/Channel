<?php
   session_start();
   if (!isset($_SESSION['admin']))
   {
	header('Location:login.php');
   }

include_once 'classes.php';
include_once 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin-Panel</title>
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
    
  <!-- Compiled and minified JavaScript -->
  <!--Import Google Icon Font-->
  <link href = "dist/css/bootstrap.min.css" rel="stylesheet" />
      <link href='https://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css"  media="screen,projection"/>
       <script type="text/javascript" src="materialize/js/jquery-3.1.0.min.js"></script>
      <script type="text/javascript" src="materialize/js/materialize.min.js"></script>    <script type="text/javascript">
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
      <li><a href="admin-panel.php?logout" class="btn waves-effect waves-light deep-orange lighten-2" style="padding-right:2em;text-decoration:none">Logout</a></li>
      </ul>
       <ul class="side-nav" id="mobile-demo">
         <li><a href="admin-panel.php?logout" style="text-decoration:none">Logout</a></li>
       </ul>
      </div>
      </nav>
</div><br><br>
<?php
   if (isset($_GET['blogger_id'])){
       $admin = new Admin($conn);
       $blogger_id = $_GET['blogger_id'];
       $all_bloggers=$admin->get_posts($blogger_id);
       if ($all_bloggers === false) {
        echo "<div class='alert alert-info'>No blogger registered</div>";
       } 
       else {
        $i = 0;
        echo '<div class="container"><table class="table table-striped"><thead><tr>
        <th>Title</th>
        <th>Creation Date</th>
        <th>Click</th>
        </tr></thead><tbody>';
        while ($i < count($all_bloggers)) {
            
            echo '<tr>
      		<td>' . $all_bloggers[$i][2] . '</td>
      		<td>' . $all_bloggers[$i][3] . '</td>
      		<td style="padding: 15px;"><a href="deletepost.php?blogger_id=' . $all_bloggers[$i][1] . '&blog_id=' . $all_bloggers[$i][0] . '"><button>Delete</button></a></td>
      		</tr>';
            $i = $i + 1;
        }
        echo '</tbody></table></div>';
    }
}

if (isset($_GET['blogger_id']) && isset($_GET['blog_id'])){
    $admin = new Admin($conn);
    $blogger_id=$_GET['blogger_id'];
    $blog_id = $_GET['blog_id'];
    $result=$admin->delete_post($blogger_id,$blog_id);
    if ($result) {
        echo "<script type='text/javascript'>alert('Post has been deleted successfully...');window.location.href = 'deletepost.php?blogger_id=" . $blogger_id . "';</script>";
    } else {
        echo "<script type='text/javascript'>alert('Something went wrong:(');window.location.href = 'deletepost.php?blogger_id=" . $blogger_id . "';</script>";
    }
}

if(isset($_GET['logout']))
{
  
  $logout =$admin->admin_logout();
  
}
?>

</body>
</html>