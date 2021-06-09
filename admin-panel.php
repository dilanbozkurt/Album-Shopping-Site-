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

if(isset($_POST["register"])){
  header('Location:register-admin.php');
}

if(isset($_POST["main"])){
  header('Location:login.php');
}

if(isset($_POST["add"])){
  header('Location:albumAdding.php');
}

if(isset($_POST["search"])){
  header('Location:admin-search.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ADMIN PANEL</title>
</head>
<body>

<header>
  <h2 id="site-name">ALBUM SHOPPING SITE </h2>
  <h3 id="small-talk"><q><i>You can find all albums here...</i></q></h3>
  <form  name="registerForm" action="" method="post">
    <input  type="submit" name="register" value="ADD NEW USER" class="addUserBtn" >
  </form>
  <form  name="mainPageForm" action="" method="post">
    <input  type="submit" name="main" value="Main Page" class="mainBtn" >
  </form>
  <form  name="addAlbumForm" action="" method="post">
    <input  type="submit" name="add" value="Add Album" class="addBtn" >
  </form>
  <!--SEARCH -->
  <form name="search" action="" method="post">
    <input id="searchButton" type="submit" name="search" value="SEARCH">
  </form>

</header>


<?php
$query = "Select * From albumattributes";
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

//UPDATE ALBUM
$db = mysqli_select_db($connect,'albums');
if(isset($_POST['update'])){

    $file = $_FILES['image_file']['name'];
    
    $id=$_POST['id'];
    $query = "UPDATE `albumattributes` SET album_image='$file',album_name='$_POST[name]',album_genre='$_POST[genre]',album_price='$_POST[price]',album_review ='$_POST[review]' WHERE id='$_POST[id]'  ";
    $query_run = mysqli_query($connect,$query);

    if($query_run){
        if(mysqli_num_rows($result)>0){
          while($row=mysqli_fetch_array($result)){
             ?>
               <div >
                 <form method="post" action="admin-panel.php?action=update&id=<?php echo $row["id"];?>">
                   <input type="text" name="id" value="<?php echo $row["id"];?>">
                   <img class="album_pic" name="image" src="images/<?php echo $row["album_image"]?>">
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
    else{
      echo '<script type="text/javascript"> alert("CANT UPDATE") </script>';
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

<style>
body{
  background-image: url("images/neutral.jpg");
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

header{
  height: 100px;
  border: solid #804900;
  border-top: 0px;
  border-left: 0px;
  border-right: 0px;
}

.addUserBtn{
  border:solid #804900;
  position: relative;
  bottom: 40px;
  left: 1350px;
  color: #804900;
  background-color: antiquewhite;
  padding: 10px;
  margin: 2px;
  border: solid rgb(226, 212, 194);
}

.mainBtn{
  border:solid  #804900 ;
  position: relative;
  bottom: 130px;
  left: 1350px;
  color: #804900;
  background-color: antiquewhite;
  padding: 10px;
  margin: 2px;
  border: solid rgb(226, 212, 194);
}

.addBtn{
  border:solid  #804900 ;
  position: relative;
  bottom: 127px;
  left: 1250px;
  color: #804900;
  background-color: antiquewhite;
  padding: 10px;
  margin: 2px;
  border: solid rgb(226, 212, 194);
}

#searchButton{
  border:solid  #804900 ;
  position: relative;
  bottom: 220px;
  left: 1250px;
  color: #804900;
  background-color: antiquewhite;
  padding: 10px;
  margin: 2px;
  border: solid rgb(226, 212, 194);
}


</style>

  
</body>
</html>