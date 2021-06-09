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


if(isset($_POST["cart"])){
  header('Location:cart.php');
}

if(isset($_POST["main"])){
  header('Location:login.php');
}

if(isset($_POST["search"])){
  header('Location:search.php');
}

if(isset($_POST["update"])){
  header('Location:update-customer.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="albums-style.css">
  <title>ALBUMS</title>
</head>
<body>

<header>
  <h2 id="site-name">ALBUM SHOPPING SITE </h2>
  <h3 id="small-talk"><q><i>You can find all albums here...</i></q></h3>
  <form name="cart" action="" method="post">
    <input id="cartButton"  type="submit" name="cart" value="YOUR CART">
  </form>
  <form name="main" action="" method="post">
    <input id="mainButton"  type="submit" name="main" value="MAIN PAGE">
  </form>

  <!--SEARCH -->
  <form name="search" action="" method="post">
    <input id="searchButton" type="submit" name="search" value="SEARCH">
  </form>

  <!--UPDATE -->
  <form name="update" action="" method="post">
  <input id="updateButton" type="submit" name="update" value="UPDATE">
  </form>
  
</header>

<br>
<?php
$query = "Select * From albumattributes";
$result =$connect->query($query);

if(mysqli_num_rows($result)>0){
   while($row=mysqli_fetch_array($result)){
      ?>
        <div class= "albums" >
          <form method="post" action="albums.php?action=add&id=<?php echo $row["id"];?>">
            <img class="image" src="images/<?php echo $row["album_image"]?>" >
            <h4 class="name"><?php echo $row["album_name"];?></h4>
            <h5><?php echo $row["album_genre"];?></h5>
            <div class="info">
              <?php echo $row["album_price"];?>$   
              <br>
              <q><?php echo $row["album_review"];?></q>     
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
?>
















</body>
</html>