<?php
$showAlert = false;
$showError = false;
if($_SERVER['REQUEST_METHOD']=="POST")
{
    
include '_dbconnect.php';
$username=$_POST["username"];
$password=$_POST["password"];
$cpassword=$_POST["cpassword"];
$check=false;
$existsql="SELECT * FROM `user` WHERE username = '$username'";
$result=mysqli_query($conn,$existsql);
$numrow=mysqli_num_rows($result);
if($numrow > 0)
{
   $showError="Username already exists";
 
}
else
{
  if(($password == $cpassword))
  {
  $hash=password_hash($password,PASSWORD_DEFAULT);
  $sql="INSERT INTO `user` ( `username`, `password`, `date`) VALUES ( '$username', '$hash', current_timestamp())";
  $result=mysqli_query($conn,$sql);
  if($result)
  {
    $showAlert=true;
    session_start();
      $_SESSION['loggedin']=true;
      $_SESSION['username']=$username;
    header("location:index.php");
  }
}
else{
  $showError="Password and Confirm password do not match";

}

}
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>signup.php</title>
  </head>
  <body>
    <?php
require '_nav.php'
?>
<?php
if($showAlert)
{
echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
<strong>Success!</strong> Your account has been created successfully.
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
</div>';
}
if($showError)
{
echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>Alert!</strong> '.$showError.'
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
</div>';
}
?>
<div class="container">
<h1 class="text-center">Signup to our website</h1>
<form action="/Loginsystem/signup.php" method="post">
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
    
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  <div class="form-group">
    <label for="cpassword">Password</label>
    <input type="password" class="form-control" id="cpassword" name="cpassword">
  </div>

  <button type="submit" class="btn btn-primary">Sign Up</button>
</form>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>