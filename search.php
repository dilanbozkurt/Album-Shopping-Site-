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

///ADD TO CART/////
if(isset($_POST["add_to_cart"])){

  if(isset($_SESSION["shopping_cart"])){
    $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
    if(!in_array($_GET["id"], $item_array_id))  
    {  
         $count = count($_SESSION["shopping_cart"]);  
         $item_array = array(  
              'item_id'  =>  $_GET["id"],  
              'item_name'  =>  $_POST["hidden_name"],  
              'item_price'   =>   $_POST["hidden_price"],
              'item_quantity'   =>   $_POST["quantity"]
         );  
         $_SESSION["shopping_cart"][$count] = $item_array;  
    }  
    else  
    {  
      echo '<script>alert("Album is in the Cart")</script>';
    }   
  }

  else{
    $item_array = array(  
      'item_id'   =>  $_GET["id"],  
      'item_name'  =>  $_POST["hidden_name"],  
      'item_price'  =>  $_POST["hidden_price"],  
      'item_quantity'  =>  $_POST["quantity"]  
    );  
    $_SESSION["shopping_cart"][0] = $item_array;  
  }
}

//REMOVE
if(isset($_GET["action"])){
  if($_GET["action"]=="delete"){
      foreach($_SESSION["shopping_cart"] as $keys => $values){
          if($values["item_id"] == $_GET["id"]){
              unset($_SESSION["shopping_cart"][$keys]);
              echo '<script>alert("Item Removed")</script>';  
              echo '<script>window.location="albums.php"</script>';
          }
      }
  }
}


if(isset($_POST["main"])){
  header('Location:albums.php');
}

if(isset($_POST["cart"])){
  header('Location:cart.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SEARCH</title>
</head>
<body>

<header>
  <h2 id="site-name">ALBUM SHOPPING SITE </h2>
  <h3 id="small-talk"><q><i>You can find all albums here...</i></q></h3>
  <form name="main" action="" method="post">
    <input id="mainButton"  type="submit" name="main" value="BACK TO ALBUMS">
  </form>
  <form name="cart" action="" method="post">
    <input id="cartButton"  type="submit" name="cart" value="YOUR CART">
  </form>
</header>

<!--SEARCH -->
<form name="search" action="" method="get">
  <input id="searchbar" type="text" name="input" placeholder="Search for album...">
  <input id="searchButton" type="submit" name="search" value="SEARCH">
</form>

<?php


if(isset($_GET['search'])){

  $input = $_GET['input'];
  $query = "SELECT * FROM albumattributes WHERE CONCAT(album_name,album_genre,album_review) LIKE '%$input%' ";
  $result =$connect->query($query);

  if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_array($result)){
        ?>
          <div class= "albums" >
            <form method="post" action="search.php?action=add&id=<?php echo $row["id"];?>">
              <img class="image" src="images/<?php echo $row["album_image"]?>" >
              <h4 class="name"><?php echo $row["album_name"];?></h4>
              <h5><?php echo $row["album_genre"];?></h5>
              <div class="info">
                <?php echo $row["album_price"];?>$   
                <br>        
                <?php echo $row["album_review"];?>
                <br>
              </div>
              <input type="text" name="quantity" value="1">
              <input type="hidden" name="hidden_name" value="<?php echo $row["album_name"]; ?>" >
              <input type="hidden" name="hidden_price" value=" <?php echo $row["album_price"];?> ">
              <input type="submit" name="add_to_cart" class="btn btn-success" value="Add to Cart" >
            </form>
          </div>
        <?php
    }
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

#searchButton{
  color: #804900;
  background-color: antiquewhite;
  border: solid rgb(226, 212, 194);
}

.albums{
  border: solid antiquewhite;
  display: inline-block;
  margin-top: 5px;
  margin-left: 25px;
}

.image{
  position: relative;
  margin-left: 55px;
  margin-top: 5px;
}

.name{
  position: relative;
  margin-left: 55px;
}

.btn{
  color: #804900;
  background-color: antiquewhite;
  border: solid rgb(226, 212, 194);
}

#cartButton{
  color: #804900;
  background-color: antiquewhite;
  padding: 10px;
  margin: 2px;
  border: solid rgb(226, 212, 194);
  position: relative;
  top: -90px;
  left: 1350px;
}


</style>