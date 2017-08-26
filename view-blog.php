<?php
include_once 'classes.php';
include_once 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Blog</title>
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
        <script type="text/javascript" src="materialize/js/materialize.min.js"></script>
        <link href='https://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <script type="text/javascript">
            $(document).ready(function () {
                $(".button-collapse").sideNav();
            })
        </script>  
    </head>
    <body style="font-family:'Lora',serif;">

        <div class="navbar-fixed ">
            <nav>
                <div class="nav-wrapper blue-grey">
                    <a href="index.php" class="brand-logo" style="text-decoration:none">Channel</a>
                    <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
                    <ul class="right hide-on-med-and-down" <?php if (!isset($_GET['username'])) { ?>>
                            <li><a href="signup.php" class =  "btn waves-effect waves-light deep-orange lighten-2">Sign Up</a></li>
                            <li><a href="login.php" class =  "btn waves-effect waves-light deep-orange lighten-2">Login</a></li></ul>
                    <?php } ?>
                    <ul class="right hide-on-med-and-down" <?php if (isset($_GET['username'])) { ?>>
                            <li><a href="write-blog.php" class =  "btn waves-effect waves-light deep-orange lighten-2">Write</a></li>
                            <li><a href="userhome.php?logout" class =  "btn waves-effect waves-light deep-orange lighten-2">Logout</a></li></ul><?php } ?> 
                    <ul class="side-nav" id="mobile-demo" <?php if (isset($_GET['username'])) { ?>>
                            <li><a href="write-blog.php" >Write</a></li>
                            <li><a href="userhome.php?logout" >Logout</a></li>
                        <?php } ?></ul>

            </nav>
                </div>
        </div>
    
    <?php
    if (isset($_GET['blog_id'])) {
        $viewer = new Viewer($conn);
        $blog_id = (int) $_GET['blog_id'];
        $blogs = $viewer->get_all_blogs('', $blog_id);
        if ($blogs == false) {
            echo "<div class = 'container'><div class='alert alert-info text-center'>No blogs published yet!</div></div>";
        } else {
            $i = 0;
            while ($i < count($blogs)) {
                echo '<div class="container">
    <img src ="' . $viewer->get_blog_image($blogs[$i][0]) . '" style="width:80%;height:40%;padding-top:2em;"/>
    <div class="page-header">
    <h1>' . $blogs[$i][2] . '<br/><small>' . $blogs[$i][4] . ',' . $blogs[$i][6];
                if (!isset($_GET['username'])) {
                    echo '<br/>More by,<a href ="profile.php?username=' . $blogs[$i][9] . '">' . $blogs[$i][8] . '</a></small></h1>';
                }
                //if user try to view his fulll blog then update should be there
                else {
                    echo '<a href = "update.php?blog_id=' . $blogs[$i][0] . '">,update</a> ';
                }
                if (!is_null($blogs[$i][7])) {
                    echo '<h3><small>Updated on ' . $blogs[$i][7] . '</small></h3>';
                }

                echo '</div>
    <h4>' . $blogs[$i][3] . '</h4>';
                $i = $i + 1;
            }
        }
    }
    if (isset($_GET["category"])) {
        $viewer = new Viewer($conn);
        $category = $_GET["category"];
        $blogs = $viewer->get_blogs_by_category($category);
        if ($blogs == false) {
            echo "<div class = 'container'><div class='alert alert-info text-center'>No blogs published yet!</div></div>";
        } else {
            $i = 0;
            while ($i < count($blogs)) {
                echo '<div class="container">
    <img src ="' . $viewer->get_blog_image($blogs[$i][0]) . '" style="width:80%;height:40%;padding-top:2em;"/>
    <div class="page-header">
    <h1>' . $blogs[$i][2] . '<br/><small>' . $blogs[$i][4] . ',' . $blogs[$i][6];
                if (!isset($_GET['username'])) {
                    echo '<br/>More by,<a href ="profile.php?username=' . $blogs[$i][9] . '">' . $blogs[$i][8] . '</a></small></h1>';
                }
                //if user try to view his fulll blog then update should be there
                else {
                    echo '<a href = "update.php?blog_id=' . $blogs[$i][0] . '">,update</a> ';
                }
                if (!is_null($blogs[$i][7])) {
                    echo '<h3><small>Updated on ' . $blogs[$i][7] . '</small></h3>';
                }

                echo '</div>
    <h4>' . $blogs[$i][3] . '</h4></div><br/><br/><br/><hr>';
                $i = $i + 1;
            }
        }
    }
    ?>
            
            <br><br><br>
            <?php
             if (isset($_GET['blog_id'])){
                 $id = $_GET['blog_id'];
                 $result = $conn->query("select * from blog_master where blog_id='$id'");
                 $results = $result->fetch_assoc();
                 $likes = $results['likes'];
                 echo '<a href="view-blog.php?blog_id='.$id.'&likes='.$likes.'"><img src="images/like.png"></a><br><br>';
                 echo "<p style='font-size: 20px; color: #039be5;'><b>".$likes." Likes</b></p><hr>";
             }
             if(isset($_GET['blog_id']) && isset($_GET['likes'])){
                 $me = new Viewer($conn);
                 $m =$_GET['blog_id'];
                 $count = $_GET['likes'];
                 $ans=$me->increaseLikes($m,$count);
                 if ($ans){
                     echo "<script type='text/javascript'>alert('Thank you!!...');window.location.href = 'view-blog.php?blog_id=".$m."';</script>";
                 }
                 else{
                     echo "<script type='text/javascript'>alert('Something went wrong:(');window.location.href = 'view-blog.php?blog_id=".$m."';</script>";
                 }
             }
            ?>
            
    <div id="comment-section">
        <div id="comment-box">
            
            <?php
                   if(isset($_GET['blog_id'])){
                       $id = $_GET['blog_id'];
                       $results=$conn->query("select * from comments where blog_id='$id' order by comment_id desc");
                   if ($results->num_rows > 0){
                       echo '<h5>Comments...</h5><hr>';
                   while ($rowsForComment = $results->fetch_object()){
                       echo '<p style="font-size:20px;"><b><font color="rgba(255, 255, 255, 0.7)">'.$rowsForComment->name.'</b></font>: &nbsp &nbsp'.$rowsForComment->comment.'</p>';
                   }}
                   else{
                       echo '<h5>No comments...</h5>';
                   }}
            ?>
            
        </div>
        <?php
            if (isset($_GET['blog_id'])){
                echo '<div id="comment">
            <hr>
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
                        <input id="msg" type="text" class="validate" name="comment" autofocus required>
                        <label for="comment">Comment</label>
                    </div>
                </div>
                <button class="btn waves-effect waves-light" type="submit" name="post">Post<i class="material-icons right">send</i>
                </button>
            </form>
        </div>
        <br><br>
    </div>';
            }
        
        ?>
        
    <?php
    if(isset($_POST['post'])){
        $date=date("Y-m-d");
        $name=$_POST['name'];
        $email=$_POST['email'];
        $comment=$_POST['comment'];
        if ($name && $email && $comment){
            $sql = $conn->query("INSERT INTO comments(name,email,comment,date,blog_id) VALUES ('$name','$email','$comment','$date','$blog_id')");
            if ($sql){
                echo "<script type='text/javascript'>alert('Thank you for posting your views...');window.location.href = 'view-blog.php?blog_id=".$blog_id."';</script>";
            }
            else{
                echo "<script type='text/javascript'>alert('Something went wrong:(');window.location.href = 'view-blog.php?blog_id=".$blog_id."';</script>";
            }
        }
    }
    ?>
</body>
</html>