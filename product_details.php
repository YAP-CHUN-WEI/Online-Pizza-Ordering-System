<?php
include ('user_session.php');
include("dbconnection.php");
include("nav.php");


if(isset($_GET['id']))
{
    $prod_id = $_GET['id'];
    $prod_price = number_format($_GET['price'],2);
    $prod_category = $_GET['category'];
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
if(isset($_POST['add_to_cart'])) 
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

    $query = "INSERT INTO cart (customer_ID, size_ID, topping_ID, crust_ID, quantity, product_id, cart_total_price) 
              VALUES ('$cus_id', '$size_id', '$topping_id', '$crust_id', '$quantity', '$prod_id', '$total_price')";//total price need to do
    $result = mysqli_query($connect, $query);

    if($result)
    {
      header("refresh: 0.2; url = product_list.php");
      exit();
    }
    else
    {
      echo "Error: ".mysqli_error($connect);
    }
}


?>

<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="product_details.css">
    <title>Product Detail - POS</title>
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

    <script>
    function showAlert() 
    {
        alert("Added to Cart");
    }
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
                echo '<option value="'.$row3["size_ID"].'">'.$row3["size_name"].' (+RM '.$row3['size_price'].')'.'</option>';
              }
            // echo '<option value="small">Small</option>';
            // echo '<option value="medium">Medium (+RM 5.00)</option>';
            // echo '<option value="large">Large (+RM 10.00)</option>';
          echo '</select>';
        echo '</li>';
        echo '<li>Toppings : ';
          echo '<select name="toppings">';
              while($row4 = mysqli_fetch_assoc($result4))
              {
                echo '<option value="'.$row4['topping_ID'].'">'.$row4['topping_name'].' (+RM '.$row4['topping_price'].')'.'</option>';
              }
            // echo '<option value="none">None</option>';
            // echo '<option value="pepperoni">Pepperoni (+RM 2.50)</option>';
            // echo '<option value="sausage">Sausage (+RM 1.50)</option>';
            // echo '<option value="mushrooms">Mushrooms (+RM 1.50)</option>';
            // echo '<option value="bacon">Bacon (+RM 2.00)</option>';
            // echo '<option value="onions">Onions (+RM 1.00)</option>';
          echo '</select>';
       echo '</li>';
        echo '<li>Crust : ';
          echo '<select name="crust">';
              while($row2 = mysqli_fetch_assoc($result2))
              {
                echo '<option value="'.$row2['crust_ID'].'">'.$row2['crust_name'].' (+RM '.$row2['crust_price'].')'.'</option>';
              }
            // echo '<option value="thick">Thick</option>';
            // echo '<option value="thin">Thin</option>';
          echo '</select>';
        echo '</li>';
        echo '<li>Quantity : ';
          echo '<input type="number" name="quantity" min="1" max="10" value="1">';
        echo '</li>';
      echo '</ul>';
      echo '<input class="submitbtn" type="submit" name="add_to_cart" onclick="showAlert()" value ="Add to Cart">';
    echo '</form>';

    mysqli_close($connect);
  ?>
  </div>
  </main>

    <footer>
      <p>&copy; 2023 Pizz Pizza System. All rights reserved.</p>
    </footer>
  </body>
</html>
