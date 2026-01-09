<!DOCTYPE html>
<html>
<head>
	<title>Payment Method page</title>
	<link rel="stylesheet" type="text/css" href="pay_method.css" />
	
	<?php
		include ('dbconnection.php');
		include ('user_session.php');
		include ('nav.php');
	?>
</head>
<body>
<?php
	$user_id = $_SESSION['uid'];
	    $query = "SELECT cart.cart_ID, cart.customer_ID, cart.product_ID, cart.size_ID, cart.topping_ID, cart.crust_ID, cart.quantity, cart.cart_total_price, cart.order_id,
              product.product_id, product.product_price, product.product_name, 
              pizza_crust.crust_name, 
              pizza_size.size_name, 
              pizza_topping.topping_name

              FROM cart INNER JOIN product ON cart.product_ID = product.product_id
                        INNER JOIN pizza_crust ON cart.crust_ID = pizza_crust.crust_ID 
                        INNER JOIN pizza_size ON cart.size_ID = pizza_size.size_ID
                        INNER JOIN pizza_topping ON cart.topping_ID = pizza_topping.topping_ID
              WHERE cart.customer_ID = $user_id
              ORDER BY cart.cart_ID";
	
	$result = mysqli_query($connect, $query);
	$sub_total = 0.00;
    $total = 0.00;
    $delivery = 4.00;
	echo'<div class="container">';
		echo'<h2>Payment Bill</h2>';
		while($row = mysqli_fetch_assoc($result))
		{	
			if($row['order_id'] == 0)
			{
				echo '<div class="list">';
                    echo '<div>';
                        echo "<img class = 'image' src='img/".$row['product_name'].'.jpg'.'?t='.time()."' alt='pizza'>";
                    echo '</div>';
                    echo '<div>';
                        echo '<span>Pizza : </span>'.$row['product_name'].'<br>';
                        echo '<span>Size : </span>'.$row['size_name'].'<br>';
                        echo '<span>Topping : </span>'.$row['topping_name'].'<br>';
                        echo '<span>Crust : </span>'.$row['crust_name'].'<br>';
                    echo '</div>';
                    echo '<div class = quantity>';
                        echo $row['quantity'].'<br>';
                    echo '</div>';
                    echo '<div class = price >';
                        echo 'RM '.$row['cart_total_price'].'<br>';
                    echo '</div>';
                    $sub_total += $row['cart_total_price'];
                echo '</div>';
				$total += $row['cart_total_price'];
			}
		}
		$totalp = $total+$delivery;

		echo'<div class="con2">';
			echo '<div>Delivery Fee : </div>';
			echo '<div class="blank">RM '.number_format($delivery, 2).'</div>';
			echo '<div>Total Price : </div>';
			echo '<div class="blank">RM '.number_format($totalp, 2).'</div>';
		echo'</div>';
	echo'</div>'
?>
	<div class="container">
		<h2>For Rider Information</h2>
		<form id="payment-form" method="post" action="">
		  <label for="name">Receiver name:</label>
		  <input type="text" id="name" placeholder="First name is fine" name="name" required><br><br>
		  
		  <label for="num">Phone number:</label>
		  <input type="text" id="num" placeholder="To contact you" name="num" required><br><br>
		  
		  <label for="adrs">Receiver Address:</label>
		  <textarea id="adrs" placeholder="E93B, Jalan arhcer 110, Taman Cyberia" name="adrs"></textarea><br><br>
		  
			<div class="payment">
				<p id="rtext">How would you like to pay?</p>
				<fieldset id="payment-options">
				  <legend>Payment Options</legend>
				  <div class="pay">
					<input type="radio" id="hleong" value="HLBank" name="paymentMethod">
					<label for="hleong">Hong Leong Bank<img src="img/hleong2.png" alt="HLBank"></label>
				  </div>
				  <div class="pay">
					<input type="radio" id="paypal" value="PayPal" name="paymentMethod">
					<label for="paypal">PayPal<img src="img/ppal.png" alt="PayPal"></label>
				  </div>
				  <div class="pay">
					<input type="radio" id="cimb" value="CIMB" name="paymentMethod">
					<label for="cimb">CIMB Bank<img src="img/cimb2.png" alt="CIMB bank"></label>
				  </div>
				</fieldset>
			</div>
			<button type="submit" name="paybtn">Pay Now</button>
		</form>
	</div>

</body>
</html>

<?php
   if (isset($_POST["paybtn"])) {
    $name = $_POST["name"];
    $p_number = $_POST["num"];
    $address = $_POST["adrs"];
    $method = $_POST["paymentMethod"];
    date_default_timezone_set("Singapore");
    $date = date("d/m/Y");
    $time = date("h:ia");

    if ($method == "") {
        ?>
        <script>
        alert("Payment failure. Please choose a payment method.");
        window.location.href = "add_to_cart.php";
        </script>
        <?php
    } else {
        $query = "INSERT INTO pizza_order (total_price, user_id, customer_name, customer_phone, customer_address, payment, purchase_date, purchase_time, payment_status)
            VALUES('$totalp','$user_id','$name', '$p_number', '$address', '$method', '$date', '$time', '1')";

        mysqli_query($connect, $query);
        $order_id = mysqli_insert_id($connect);

        if ($method == "HLBank") {
            ?>
            <script>
            let newWindow = window.open('https://www.hlb.com.my/en/personal-banking/home.html', '_blank');
            setTimeout(function() {
                newWindow.close();
                window.location.href = "pizza_status.php?p1&order_id=<?php echo $order_id; ?>";
            }, 3000);
            </script>
            <?php
        } else if ($method === 'PayPal') {
            ?>
            <script>
            let newWindow = window.open('https://www.paypal.com/my/home', '_blank');
            setTimeout(function() {
                newWindow.close();
                window.location.href = "pizza_status.php?p1&order_id=<?php echo $order_id; ?>";
            }, 3000);
            </script>
            <?php
        } else if ($method === 'CIMB') {
            ?>
            <script>
            let newWindow = window.open('https://www.cimbclicks.com.my/', '_blank');
            setTimeout(function() {
                newWindow.close();
                window.location.href = "pizza_status.php?p1&order_id=<?php echo $order_id; ?>";
            }, 3000);
            </script>
            <?php
        }

        $query1 = "UPDATE cart SET order_id = '$order_id' WHERE customer_ID = '$user_id' AND order_id = '0'";
        mysqli_query($connect, $query1);

        mysqli_close($connect);
    }
}

?>