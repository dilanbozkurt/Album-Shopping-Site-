<?php

$server="localhost";
$user="root";
$password ="10471391.gh";
$database ="users";
$connect = mysqli_connect($server,$user,$password,$database);
if(!$connect){
  die("fail".mysqli_connect_error());
}

if(isset($_POST["main"])){
  header('Location:admin-panel.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>REGISTER</title>
</head>

<header>
    <h2 id="site-name">ALBUM SHOPPING SITE </h2>
    <h3 id="small-talk"><q><i>You can find all albums here...</i></q></h3>
    <form name="main" action="" method="post">
      <input id="mainButton"  type="submit" name="main" value="ADMIN PANEL">
    </form>
</header>

<body>


  <form action="register-admin.php" method="post" id="myForm">
    User type:
    <br>
    <input type="text" name="type">
    <br>
    Create user name:
    <br>
    <input type="text" name="user_name">
    <br>
    Create Password:
    <br>
    <input type="password" name="user_password">
    <br>
    <button type="submit" name="send" value="sending" class="button" id="registerBtn">
      REGISTER
    </button>
  </form>

</body>
</html>

<?php

if(isset($_POST["type"],$_POST["user_name"],$_POST["user_password"])){

  $username = $_POST["user_name"];
  $userpassword = $_POST["user_password"];
  $type = $_POST["type"];

  $querry = "INSERT INTO userattributes(type,name,password) VALUES ('".$type."' ,'".$username."','".$userpassword."')";

  if($connect->query($querry)===TRUE){
    echo '<script type="text/javascript"> alert("A NEW ADMIN IS REGISTERED") </script>';
  }
  else{
    echo '<script type="text/javascript"> alert("CAN NOT BE REGISTERED") </script>';
  }

}


?>

<style>

body{
  background-image: url("images/neutral.jpg");
}

header{
  height: 100px;
  border: solid #804900;
  border-top: 0px;
  border-left: 0px;
  border-right: 0px;
}

header{
  height: 100px;
  border: solid #804900;
  border-top: 0px;
  border-left: 0px;
  border-right: 0px;
}

#mainButton{
  color: #804900;
  background-color: antiquewhite;
  padding: 10px;
  margin: 2px;
  border: solid rgb(226, 212, 194);
  position: relative;
  top: -100px;
  left: 1350px;
}

#myForm{
  border: rgb(160, 107, 42);
  width: fit-content;
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  padding-left: 15px;
  padding-right: 15px;
  padding-bottom: 150px;
  background-color: rgba(235, 218, 148, 0.527);
  color: rgba(136, 62, 10, 0.801);
}

#registerBtn{
  position: fixed;
  bottom: 120px;
  background-color: darkkhaki;
  border: solid darkkhaki ;
  color: antiquewhite;
}

</style>