<?php
$server="localhost";
$user="root";
$password ="10471391.gh";
$database ="users";

$connect = mysqli_connect($server,$user,$password,$database);

if(!$connect){
  die("fail".mysqli_connect_error());
}

if(isset($_POST["login"])){
  header('Location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="login.css">
  <title>REGISTER</title>
</head>

<header>
  <h2 id="site-name">ALBUM SHOPPING SITE </h2>
  <h3 id="small-talk"><q><i>You can find all albums here...</i></q></h3>
</header>

<body>

  <form action="register.php" method="post">
    Create user name:
    <br>
    <input type="text" name="user_name">
    <br>
    Create Password:
    <br>
    <input type="password" name="user_password">
    <br>
    <button type="submit" name="send" value="sending" class="button">REGISTER</button>
    <br>

    <form name="toLogin" action="" method="post">
      <input type="submit" name="login" value="LOGIN" class="login-btn">
    </form>
   
  </form>


</body>
</html>

<?php

if(isset($_POST['send'])){

  if(isset($_POST["user_name"],$_POST["user_password"])){

    $username = $_POST["user_name"];
    $userpassword = $_POST["user_password"];
  
    $querry = "INSERT INTO userattributes(name, password) VALUES ('".$username."','".$userpassword."')";
  
    if($connect->query($querry)===TRUE){
      echo '<script type="text/javascript"> alert("YOU ARE REGISTERED") </script>';
    }
    else{
      echo '<script type="text/javascript"> alert("CAN NOT REGISTER") </script>';
    }
  
  }

}


?>

<style>
    .login-btn{
      position: fixed;
      bottom: 50px;
      background-color: darkkhaki;
      border: solid darkkhaki ;
      color: antiquewhite;
    }
</style>