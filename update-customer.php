<?php

session_start();

$server="localhost";
$user="root";
$password ="10471391.gh";
$database ="users";
$connect = mysqli_connect($server,$user,$password,$database);

if(!$connect){
  die("fail".mysqli_connect_error());
}

if(isset($_POST["back"])){
  header('Location:albums.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UPDATE CUSTOMER</title>
</head>
<body>

<header>
    <h2 id="site-name">ALBUM SHOPPING SITE </h2>
    <h3 id="small-talk"><q><i>You can find all albums here...</i></q></h3>
    <form action="" method="post">
    <input id="albumsButton"  type="submit" name="back" value="ALBUMS">
    </form>
</header>

<?php

$query = "Select * From userattributes";
$result =$connect->query($query);

if(mysqli_num_rows($result)>0){
  $row=mysqli_fetch_array($result);
  ?>
    <div>
      <form id="myForm" method="post" action="update-customer.php?action=update&id=<?php echo $_SESSION["id"];?>">
        <br><br>
         UPDATE NAME:
        <input type="text" name="name" value="<?php echo $_SESSION["name"];?>">
        <br><br>
         UPDATE PASSWORD:
        <input type="text" name="password" value="<?php echo $_SESSION["password"];?>">
        <br>
        <input type="submit" name="update" value="UPDATE" class="button">
      </form>
    </div>
  <?php
}

$db = mysqli_select_db($connect,'users');
if(isset($_POST['update'])){
  $id = $_SESSION["id"];
  $name = $_POST["name"];
  $password =$_POST["password"];

  $query = "UPDATE `userattributes` SET name='".$name."', password='".$password."' WHERE id='".$id."' ";
  $query_run = mysqli_query($connect,$query);

  echo '<script type="text/javascript"> alert("DATA IS UPDATED") </script>';

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

#albumsButton{
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
  top: 40%;
  left: 50%;
  transform: translate(-50%, -50%);
  padding-left: 15px;
  padding-right: 15px;
  padding-bottom: 150px;
  background-color: rgba(235, 218, 148, 0.527);
  color: rgba(136, 62, 10, 0.801);
}

.button{
  position: fixed;
  bottom: 120px;
  background-color: darkkhaki;
  border: solid darkkhaki ;
  color: antiquewhite;
}

</style>



</body>
</html>