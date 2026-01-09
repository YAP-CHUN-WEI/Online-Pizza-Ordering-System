<?php
session_start();
include("dbconnection.php");

if(isset($_GET['edit']))
{   
    $cart_id = $_GET['cart_id'];
    $prod_id = $_GET['prod_id'];
    $cart_size = $_GET['size'];
    $cart_topp = $_GET['topping'];
    $cart_crust = $_GET['crust'];
    $cart_quant = $_GET['quantity'];

    $query = "SELECT * FROM product WHERE product_id = $prod_id";
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_assoc($result);

    //try here !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!1
    $query2 = "SELECT * FROM pizza_crust";
    $result2 = mysqli_query($connect, $query2);

    $query3 = "SELECT * FROM pizza_size";
    $result3 = mysqli_query($connect, $query3);

    $query4 = "SELECT * FROM pizza_topping";
    $result4 = mysqli_query($connect, $query4);
} 


// Handle the form submission
if(isset($_POST['edit'])) 
{   
    // Retrieve the values from the form
    $size_id = $_POST['size'];
    $topping_id = $_POST['toppings'];
    $crust_id = $_POST['crust'];
    $quantity = $_POST['quantity'];
    $cus_id = $_SESSION['uid'];
    $price = number_format($_GET["price"],2);
    
    while($row3 = mysqli_fetch_assoc($result3))
    {
      if($size_id == $row3['size_ID'])
      {
        $size = $row3['size_price'];
      }
    }

    while($row4 = mysqli_fetch_assoc($result4))
    {
      if($topping_id == $row4['topping_ID'])
      {
        $topp_price = $row4['topping_price'];
      }
    }

    while($row2 = mysqli_fetch_assoc($result2))
    {
      if($crust_id == $row2['crust_ID'])
      {
        $crust = $row2['crust_price'];
      }
    }
    
    $total_price = ($price + $crust + $size + $topp_price) * $quantity;

    $query = "UPDATE cart SET customer_ID = '$cus_id', crust_ID = '$crust_id', size_ID = '$size_id', topping_ID = '$topping_id', product_ID = '$prod_id', quantity = '$quantity', cart_total_price = '$total_price'
              WHERE cart_ID = $cart_id";
    $result = mysqli_query($connect, $query);

    ?>
        <script>
            alert("Edited sucessfully !");
        </script>
    <?php

    header("refresh: 0.2; url = add_to_cart.php");  
}

function checking()
{
  if($cart_topp == $row4['topping_ID'])
  {
    echo 'selected="selected"';
  }
}


?>

<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="add_to_cart_edit.css">
    <title>Add to Cart Edit</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script>
      window.addEventListener('scroll', function() 
      {
        var navBar = document.querySelector('.nav-bar');
        if (window.scrollY > 100) {
        navBar.classList.add('scroll-up');
        } else {
        navBar.classList.remove('scroll-up');
        }
      });
    </script>
  </head>

  <body>
  <main>
    
  <div>
  <?php 
    echo '<h2>'.$row['product_name'].'</h2>';
    echo '<h3>RM '.$row['product_price'].'</h3>';
    echo '<img src="img/'.$row['product_name'].'.jpg" alt="'.$row['product_name'].'.jpg">';
    echo '<p>'.$row['product_description'].'</p>';
    echo '<form name="edit_form" method="post" action="">';
        echo '<ul>';
            echo '<li>Size : ';
                echo '<select name="size">';
                  while($row3 = mysqli_fetch_assoc($result3))
                  { 
                    echo '<option value="'.$row3["size_ID"].'" '.($cart_size == $row3['size_ID'] ? 'selected="selected"' : '').'>'.$row3["size_name"].' (+RM '.$row3['size_price'].')'.'</option>';
                  }
                echo '</select>';
            echo '</li>';
            echo '<li>Toppings : ';
                echo '<select name="toppings">';
                  while($row4 = mysqli_fetch_assoc($result4))
                  { 
                    echo '<option value="'.$row4["topping_ID"].'" '.($cart_topp == $row4['topping_ID'] ? 'selected="selected"' : '').'>'.$row4["topping_name"].' (+RM '.$row4['topping_price'].')'.'</option>';
                  }
                echo '</select>';
            echo '</li>';
            echo '<li>Crust : ';
                echo '<select name="crust">';
                  while($row2 = mysqli_fetch_assoc($result2))
                  { 
                    echo '<option value="'.$row2["crust_ID"].'" '.($cart_crust == $row2['crust_ID'] ? 'selected="selected"' : '').'>'.$row2["crust_name"].' (+RM '.$row2['crust_price'].')'.'</option>';
                  }
                echo '</select>';
            echo '</li>';
            echo '<li>Quantity : ';
                ?>
                    <input type="number" name="quantity" min="1" max="10" value="<?php echo $cart_quant;?>">
                <?php
            echo '</li>';
        echo '</ul>';

        echo '<div class = lastrow>';
            ?>
                <p><a class = 'back' href="add_to_cart.php">Back</a></p>
            <?php
            echo '<p><input class="editbtn" type="submit" name="edit" value ="Edit"></p>';
        echo '</div>';

    echo '</form>';
    
    mysqli_close($connect);
  ?>
  </div>
  </main>
  </body>
</html>
