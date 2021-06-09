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

if(isset($_GET["action"])){
  if($_GET["action"]=="delete"){
      foreach($_SESSION["shopping_cart"] as $keys => $values){
          if($values["item_id"] == $_GET["id"]){
              unset($_SESSION["shopping_cart"][$keys]);
              echo '<script>alert("Item Removed")</script>';  
              echo '<script>window.location="cart.php"</script>';
          }
      }
  }
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
  <link rel="stylesheet" href="cart-style.css">
  <title>Document</title>
</head>
<body>

<header>
  <h2 id="site-name">ALBUM SHOPPING SITE </h2>
  <h3 id="small-talk"><q><i>You can find all albums here...</i></q></h3>
  <form action="" method="post">
    <input id="cartButton"  type="submit" name="back" value="ALBUMS">
  </form>
</header>

<br>
<div class="display-cart"  >
  <h3>Order Details</h3>  
  <table >
    <tr>
      <th class="cartTitle">Item Name</th>
      <th class="cartTitle">Quantity</th>
      <th class="cartTitle">Price</th>
      <th class="cartTitle">Total</th>
      <th class="cartTitle">Action</th>
    </tr>
    <?php
    if(!empty($_SESSION["shopping_cart"])){
        $total =0;
        foreach($_SESSION["shopping_cart"] as $keys => $values){
          ?>
          <tr>
            <td class="row"> <?php echo $values["item_name"]; ?> </td>
            <td class="row"><?php echo $values["item_quantity"]; ?></td>
            <td class="row">$<?php echo $values["item_price"]; ?> </td> 
            <td class="row">$<?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td> 
            <td class="row" ><a href="cart.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>  
          </tr class="row">
          <?php
              $total = $total+($values["item_quantity"] * $values["item_price"]);
        }
        ?>
        <tr>  
          <td class="row">Total</td>  
          <td class="row">$ <?php echo number_format($total, 2); ?></td>   
        </tr>
        <?php
    }
    ?>
  </table>

  <div class="buyingInfo" id="buying" style="display: none;">  
    <form action="cart.php" method="post">
    ADDRESS INFO: <input type="text" name="address" placeholder="Type address..." required>
    <br>
    WIRE TRANSFER <input type="radio" name="payment" value="wire" required>
    CREDIT CARD  <input type="radio" name="payment" value="credit" required>
    <br>
    <input id="orderButton" type="submit" name="add_to_order" value="ORDER !">
    </form>
    </div>

    <button id='buyButton' onclick="displayBuyingPage();">ENTER INFO</button>

  </div>

<script>
  function displayBuyingPage() {
  var x = document.getElementById("buying");
  if (x.style.display == "none") {
      x.style.display = "block"; 
  } else {
      x.style.display = "none";  
  }
}
</script>


<?php
if(isset($_POST['add_to_order'])){

  $database = "order";
  $connect = mysqli_connect($server,$user,$password,$database);

  $customer_id = $_SESSION["id"];
  $address = $_POST['address'];
  if($_POST['payment']=="wire"){
    $payment = "wire";
  }
  else{
    $payment="credit";
  }
  
  foreach($_SESSION['shopping_cart'] as $keys => $values){
    $item_id = $values['item_id'];
    $item_quantity = $values['item_quantity'];

    $query = "INSERT INTO orderattributes (customer_id,product_id,quantity,address,payment_method) VALUES('".$customer_id."','".$item_id."','".$item_quantity."','".$address."','".$payment."')";
    $result =$connect->query($query);
  }
  if($result){
    $address="";
    $payment="";
  }else{
    echo "<script>alert('CAN NOT ORDER!!')</script>";
  }

}
?>


</body>
</html>