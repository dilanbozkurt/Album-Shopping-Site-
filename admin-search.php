<?php

session_start();

$server="localhost";
$user="root";
$password ="10471391.gh";
$database ="albums";
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
  <title>Admin Search</title>
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
<!--SEARCH -->
<form name="search" action="" method="get">
  <input id="searchbar" type="text" name="input" placeholder="Search for album...">
  <input id="searchButton" type="submit" name="search" value="SEARCH">
</form>
<br>

<?php
if(isset($_GET['search'])){

  $input = $_GET['input'];
  $query = "SELECT * FROM albumattributes WHERE CONCAT(album_name,album_genre,album_review) LIKE '%$input%' ";
  $result =$connect->query($query);

  if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_array($result)){
       ?>
         <div>
           <form method="post" enctype="multipart/form-data" action="admin-panel.php?action=update&id=<?php echo $row["id"];?>">
            <input type="text" name="id" value="<?php echo $row["id"];?>">
             <img class="album_pic" name="image" src="images/<?php echo $row["album_image"]?>">
             <input type="file" name="image_file">
             <input type="text" name="name" value="<?php echo $row["album_name"];?>">
             <input type="text" name="genre" value="<?php echo $row["album_genre"];?>">
             <input type="text" name="price" value="<?php echo $row["album_price"];?>">
             <input type="text" name="review" value="<?php echo $row["album_review"];?>">
             <input type="submit" name="update" value="UPDATE" class="button" >
             <input type="submit" name="delete" value="DELETE" class="button" >
           </form>
         </div>
       <?php
    }
}

}
//DELETE ALBUM
if(isset($_POST['delete'])){
  $id=$_POST['id'];
  $query = "DELETE from `albumattributes` WHERE id='$_POST[id]' ";
  $query_run = mysqli_query($connect,$query);
  if($query_run){
    echo '<script type="text/javascript"> alert("Album is Deleted") </script>';
  }
  else{
    echo '<script type="text/javascript"> alert("CAN NOT DELETE") </script>';
  }
}

?>


</body>
</html>

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

.album_pic{
  position: relative;
  top:8px;
}

div{
  border: solid 1px rgba(235, 218, 148, 0.527);
}

.button{
  background-color: darkkhaki;
  border: solid darkkhaki ;
  color: antiquewhite;
}


</style>