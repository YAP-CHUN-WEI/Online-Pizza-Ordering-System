<!DOCTYPE html>
<html>
<head>
    <title>Add to Cart</title>
    <link rel="stylesheet" href="add_to_cart.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head> 
<script>
    function confirmation()
    {	
        var answer = confirm("Do you want to delete this pizza?");
        return answer;
    }
</script>
<body>
<?php 
    include ('dbconnection.php');
    include ('user_session.php');
    include ('nav.php');

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
              ORDER BY cart.cart_ID";//need to take user database later, can use 3 table join together
    
    $result = mysqli_query($connect, $query);

    $sub_total = 0;
    $del = 4.00;
    $total = 0;

    $count = 0;
    echo '<div class = content>';
        while($row = mysqli_fetch_assoc($result))
        {   
            if($row['order_id'] == 0)
            {
                echo '<div class = list>';
                    echo '<div class = btn >';
                        echo '<a class="editbtn" href="add_to_cart_edit.php?edit&cart_id='.$row['cart_ID'].'&prod_id='.$row['product_id'].
                        '&size='.$row['size_ID'].'&topping='.$row['topping_ID'].'&crust='.$row['crust_ID'].
                        '&quantity='.$row['quantity'].'&price='.$row['product_price'].'">Edit</a><br>';
                        echo '<a class="deletebtn" href="?del&cart_id='.$row['cart_ID'].'" onclick="return confirmation();">X</a>';   
                    echo '</div>';
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
                echo '</div>';

                $count ++;
                $sub_total += $row['cart_total_price'];
            }
        }

        if($count == 0)
        {   
            ?>
                <script>
                    alert("The cart is empty !");
                    location.href="after_product_list.php";
                </script>
            <?php
        }
        $total = $sub_total + $del;

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
        echo '<div class = backPTP>';
            echo '<a class = back href="product_list.php" onclick=window.history.go()>Back</a>';
            echo '<a class = "proceedTP" href="pay_method.php?total='.$total.'">Proceed to Payment</a>';//also need to add the user id inside
        echo '</div>'; 
        
    echo '</div>';
    //can add the total price as well as edit/delete button then also proceed to payment!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    
    if(isset($_GET['del']))
    {   
        $cart_id = $_GET['cart_id'];
        
        $query = "DELETE FROM cart WHERE cart_ID = $cart_id";
        $result = mysqli_query($connect,$query);
        ?>
        <script>
            location.href="add_to_cart.php";
        </script>
        <?php
    }
    
    mysqli_close($connect);
?>
