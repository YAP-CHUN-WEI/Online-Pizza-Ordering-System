<!DOCTYPE html>
<html>
<head>
  <title>Pizza Tracker</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="pizza_status.css">

  <?php
		include ('dbconnection.php');
		include ('user_session.php');
		include ('nav.php');
	?>
  <script>
    function confirmation() {
      var answer = confirm("Do you want to cancel this order?");
      return answer;
    }
  </script>
</head>
<body>
  <div class="pizza-tracker">
    <?php
    $order_id = $_GET['order_id'];

    $query = "SELECT * FROM pizza_order WHERE order_id = $order_id";
    $result = mysqli_query($connect, $query);
    $row =  mysqli_fetch_assoc($result);

    echo '<h1>Order Status</h1><br>';

    if(isset($_GET['back']))
    {
      if($row['pickup'] == '0')
      {
        ?>
        <script>
            window.location.href = "pizza_status.php?p2&order_id=<?php echo $order_id;?>";
        </script>
        <?php
      }
      else if($row['delivered'] == '0')
      {
        ?>
        <script>
            window.location.href = "pizza_status.php?p3&order_id=<?php echo $order_id;?>";
        </script>
        <?php
      }
      else if($row['user_confirmation'] == '0')
      {
        ?>
        <script>
            window.location.href = "pizza_status.php?p4&order_id=<?php echo $order_id;?>";
        </script>
        <?php
      }
    }

    if(isset($_GET['p1']))
    {
        ?>
        <script>
            setTimeout(function() {
              window.location.href = "pizza_status.php?p2&order_id=<?php echo $order_id;?>";
            }, 	5000);
        </script>
        <?php
    ?>
    <section class="pizza-tracker">
      <div class="pizza-step">
        <div class="pizza-step-icon">
          <img src="img/loading.gif" alt="Process 1">
        </div>
        <div class="pizza-step-text">Sending Order...</div>
        <div class="pizza-step-bar">
          <div class="pizza-step-bar-fill"></div>
        </div>
      </div>
      <?php
      }
      else if(isset($_GET['p2']))
      {	
        ?>
        <script>
            setTimeout(function() {
              window.location.href = "pizza_status.php?p2&order_id=<?php echo $order_id;?>";
            }, 	10000);
        </script>
        <?php
        if($row['payment_status'] == '0')
        {
          ?>
          <script> 
            alert("Order cancelled successfully!");
            window.location.href = "after_main.php";
          </script>
          <?php
        }
        else
        {
          if($row['pickup'] == '1')
          {
            ?>
            <script> 
              window.location.href = "pizza_status.php?p3&order_id=<?php echo $order_id;?>";
            </script>
            <?php
          }
        ?>
        <div class="pizza-step">
          <div class="pizza-step-icon">
            <img src="img/order_received.png" alt="Process 1">
          </div>
          <div class="pizza-step-text">Order Received</div>
          <div class="pizza-step-bar">
            <div class="pizza-step-bar-full"></div>
          </div>
        </div>
        <div class="pizza-step">
          <div class="pizza-step-icon">
            <img src="img/preparing1.gif" alt="Step 2">
          </div>
          <div class="pizza-step-text">Preparing</div>
          <div class="pizza-step-bar">
            <div class="pizza-step-progress" style="width: 100%;"></div>
          </div>
        </div>
        <div class="cancel">
          <a href="pizza_status.php?p2&cancel&order_id=<?php echo $order_id;?>" onclick="return confirmation()">Cancel Order</a>
        </div>
      <?php
        }
      }
      else if(isset($_GET['p3']))
      {
        ?>
        <script>
            setTimeout(function() {
              window.location.href = "pizza_status.php?p3&order_id=<?php echo $order_id;?>";
            }, 	10000);
        </script>
        <?php
        
          if($row['delivered'] == '1')
          {
            ?>
            <script> 
              window.location.href = "pizza_status.php?p4&order_id=<?php echo $order_id;?>";
            </script>
            <?php
          }
        ?>
        <div class="pizza-step">
          <div class="pizza-step-icon">
            <img src="img/order_received.png" alt="Process 1">
          </div>
          <div class="pizza-step-text">Order Received</div>
          <div class="pizza-step-bar">
            <div class="pizza-step-bar-full"></div>
          </div>
        </div>
        <div class="pizza-step">
          <div class="pizza-step-icon">
            <img src="img/prepare_stop.png" alt="Step 2">
          </div>
          <div class="pizza-step-text">Done Preparing</div>
          <div class="pizza-step-bar">
            <div class="pizza-step-bar-full"></div>
          </div>
        </div>
        <div class="pizza-step">
          <div class="pizza-step-icon">
            <img src="img/deliver.gif" alt="Step 4">
          </div>
          <div class="pizza-step-text">Out for Delivery</div>
          <div class="pizza-step-bar">
            <div class="pizza-step-progress" style="width: 50%;"></div>
          </div>
        </div>
      <?php
      }
      else if(isset($_GET['p4']))
      {
      ?>
      <div class="pizza-step">
        <div class="pizza-step-icon">
          <img src="img/order_received.png" alt="Process 1">
        </div>
        <div class="pizza-step-text">Order Received</div>
        <div class="pizza-step-bar">
          <div class="pizza-step-bar-full"></div>
        </div>
      </div>
      <div class="pizza-step">
        <div class="pizza-step-icon">
          <img src="img/prepare_stop.png" alt="Step 2">
        </div>
        <div class="pizza-step-text">Done Preparing</div>
        <div class="pizza-step-bar">
          <div class="pizza-step-bar-full"></div>
        </div>
      </div>
      <div class="pizza-step">
        <div class="pizza-step-icon">
          <img src="img/deliver_stop.png" alt="Step 4">
        </div>
        <div class="pizza-step-text">Delivered</div>
        <div class="pizza-step-bar">
          <div class="pizza-step-bar-full"></div>
        </div>
      </div>
    </section>
    <div class="received">
      Have you received the order?
      <a href="pizza_status.php?p4&received&order_id=<?php echo $order_id;?>">Received</a>
    </div>
    <?php
    if(isset($_GET['received']))
    {
      $query1 = "UPDATE pizza_order SET user_confirmation = '1' WHERE order_id = $order_id";
      
      if(mysqli_query($connect, $query1))
      {
        ?>
          <script> 
            alert("Thank you. Please enjoy your meal :)");
            window.location.href = "after_main.php";
          </script>
          <?php
      }
    }
    }

    if(isset($_GET['cancel']))
    {
      $query2 = "UPDATE pizza_order SET payment_status = '0' WHERE order_id = $order_id";
      
      if(mysqli_query($connect, $query2))
      {
        ?>
          <script> 
            alert("Order cancelled successfully!");
            window.location.href = "after_main.php";
          </script>
          <?php
      }
    }
    
  
  echo '<div class="order-details">';
    echo '<div class="time-date">';
      echo '<span style="time">'.$row['purchase_time'].'</span>';
      echo '<span class="date">'.$row['purchase_date'].'</span>';
    echo '</div>';
    echo '<h2 class="order-details-title">Order Details</h2>';

    $order_id = $_GET['order_id'];
    $sub_total = 0.00;
    $total = 0.00;
    $del = 4.00;

    $query1 = "SELECT cart.cart_ID, cart.customer_ID, cart.product_ID, cart.size_ID, cart.topping_ID, cart.crust_ID, cart.quantity, cart.cart_total_price, cart.order_id, 
                    product.product_id, product.product_price, product.product_name, 
                    pizza_crust.crust_name, 
                    pizza_size.size_name, 
                    pizza_topping.topping_name

    FROM cart INNER JOIN product ON cart.product_ID = product.product_id
                INNER JOIN pizza_crust ON cart.crust_ID = pizza_crust.crust_ID 
                INNER JOIN pizza_size ON cart.size_ID = pizza_size.size_ID
                INNER JOIN pizza_topping ON cart.topping_ID = pizza_topping.topping_ID
    WHERE cart.order_id = '$order_id'";

    $result1 = mysqli_query($connect, $query1);
    
    while ($row1 = mysqli_fetch_assoc($result1))
    {   
        echo '<div class="list">';
            echo '<div>';
                echo "<img class = 'image' src='img/".$row1['product_name'].'.jpg'.'?t='.time()."' alt='pizza'>";
            echo '</div>';

            echo '<div>';
                echo '<span>Pizza : </span>'.$row1['product_name'].'<br>';
                echo '<span>Size : </span>'.$row1['size_name'].'<br>';
                echo '<span>Topping : </span>'.$row1['topping_name'].'<br>';
                echo '<span>Crust : </span>'.$row1['crust_name'].'<br>';
            echo '</div>';
            
            echo '<div class = quantity>';
                echo $row1['quantity'].'<br>';
            echo '</div>';
            echo '<div class = price >';
                echo 'RM '.$row1['cart_total_price'].'<br>';
            echo '</div>';
            $sub_total += $row1['cart_total_price'];
        echo '</div>';
    }    
    $total = $sub_total + $del;
    echo '<div class = blank>';
        echo '<div class = payment>';
            echo '<p>Subtotal : </p>';
            echo '<p>RM '.number_format($sub_total,2).'</p>';
            echo '<P>Delivery Fee : </p>';
            echo '<p>RM '.number_format($del,2).'</p>';
          echo '</div>';  
          echo '<div class = payment>';
            echo '<P>Total : </p>';
            echo '<p>RM '.number_format($total,2).'</p>';
        echo '</div>';
  echo '</div>';
  
  mysqli_close($connect);
  ?>
  
</body>
</html>



