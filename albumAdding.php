<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ADD ALBUM</title>
</head>
<body>

<header>
  <h2 id="site-name">ALBUM SHOPPING SITE </h2>
  <h3 id="small-talk"><q><i>You can find all albums here...</i></q></h3>
  <form name="main" action="" method="post">
    <input id="mainButton"  type="submit" name="main" value="ADMIN PANEL">
  </form>
</header>

<br>
  <div class="newItem">
    <form action="albumAdding.php" method="post" id="myForm">
      Album Image: <input class="input" type="file" name="album_image" id="image">
      <br><br>
      Album Name: <input class="input" type="text" placeholder="Type Album Name" name="album_name">
      <br><br>
      Album Genre: <input class="input" type="text" placeholder="Type Album Genre" name="album_genre">
      <br><br>
      Album Price : <input class="input" type="text" placeholder="Type Album Price" name="album_price">
      <br><br>
      Album Review: <input class="input" type="text" placeholder="Type Album Review" name="album_review">
      <br><br>
      <button class="input" id= "addbtn" type="submit" >ADD Album</button>
    </form>
  </div>
  
</body>
</html>

<?php
$server="localhost";
$user="root";
$password ="10471391.gh";
$database ="albums";

$connect = mysqli_connect($server,$user,$password,$database);

if(!$connect){
  die("fail".mysqli_connect_error());
}

if(isset($_POST["album_image"],$_POST["album_name"],$_POST["album_genre"],$_POST["album_price"],$_POST["album_review"])){

  $albumimage = $_POST["album_image"];
  $albumname = $_POST["album_name"];
  $albumgenre = $_POST["album_genre"];
  $albumprice = $_POST["album_price"];
  $albumreview = $_POST["album_review"];

  $query ="INSERT INTO albumattributes(album_image,album_name,album_genre,album_price,album_review) VALUES ('".$albumimage."','".$albumname."','".$albumgenre."','".$albumprice."','".$albumreview."')";

  if($connect->query($query)===TRUE){
    echo '<script>alert("Album is Added")</script>';
  }
  else{
    echo '<script>alert("Can not Add")</script>';
  }
}

if(isset($_POST["main"])){
  header('Location:admin-panel.php');
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

#addbtn{
  position: fixed;
  bottom: 120px;
  background-color: darkkhaki;
  border: solid darkkhaki ;
  color: antiquewhite;
}



</style>