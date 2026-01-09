<!DOCTYPE html>
<html>
<head>
    <title>Accept List</title>
    <link rel='stylesheet' type='text/css' href='accept_list.css'>

    <?php 
        include("dbconnection.php");
        include("rider_session.php");  
        include("rider_nav.php");
    ?>
</head>
<body>
<script>
    function confirmation()
    {	
        var answer = confirm("Do you want to accept this order?");
        return answer;
    }

    function pickConfirmation()
    {	
        var answer = confirm("Have you picked up this order?");
        return answer;
    }

    function delConfirmation()
    {	
        var answer = confirm("Have you delivered this order?");
        return answer;
    }
</script>
<?php
    $rider_id = $_SESSION['riderID'];

    $query = "SELECT * FROM pizza_order WHERE rider_id = '$rider_id' AND delivered = '0' AND user_confirmation = '0' AND payment_status = '1'";
    $result = mysqli_query($connect, $query);

    echo '<div class="content">';
        echo '<div class="my_list">My Order List</div>';

    if(mysqli_num_rows($result)>0)
    {   
        while($row = mysqli_fetch_assoc($result))
        {
            echo '<a class="order" href="accept_list.php?list&order_id='.$row['order_id'].'&pickup='.$row['pickup'].'&del='.$row['delivered'].'"  style="text-decoration: none;">';
                echo '<div class="item">';
                    echo '<p>' . $row['order_id'] . '</p>';
                echo '</div>';
                echo '<div class="item">';
                    echo '<p>Customer: <br></p>';
                    echo $row['customer_name'];
                echo '</div>';
                echo '<div class="item">';
                    echo '<p>Phone: <br></p>';
                    echo $row['customer_phone'];
                echo '</div>';
                echo '<div class="item">';
                    echo '<p>Address: <br></p>';
                    echo $row['customer_address'];
                echo '</div>';
                echo '<div class="item">';
                    echo '<p>Total: <br></p>';
                    echo 'RM'.$row['total_price'];
                echo '</div>';
                echo '<div class="item">';
                    echo '<p>Payment: <br></p>';
                    echo $row['payment'];
                echo '</div>';
                echo '<div class="item">';
                    echo '<p>Date: <br></p>';
                    echo $row['purchase_date'];
                echo '</div>';
                echo '<div class="item-last">';
                    echo '<p>Time: <br></p>';
                    echo $row['purchase_time'];
                echo '</div>';
            echo '</a>';
            if(isset($_GET['list']) && $row['order_id'] == $_GET['order_id'])
            {   
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

                        if(isset($_GET['pickup']))
                        {   
                            $pickup = $_GET['pickup'];
                            $delivered = $_GET['del'];

                            if($pickup == '0')
                            {
                                echo '<div class = btn>';
                                echo '<a class = "conbtn" href="accept_list.php?list&pick&order_id='.$row['order_id'].'&pickup='.$pickup.'&del='.$delivered.'" onclick="return pickConfirmation();">Picked Up</a>';
                                echo '</div>';

                                if(isset($_GET['pick']))
                                {
                                    $or_id = $_GET['order_id'];

                                    $query = "UPDATE pizza_order SET pickup = '1' WHERE order_id = '$or_id'";
                                    mysqli_query($connect, $query);
                                    
                                    echo '<script>window.location.href="accept_list.php"</script>';
                                }
                            }
                            else if($delivered == '0')
                            {
                                echo '<div class = btn>';
                                echo '<a class = "conbtn" href="accept_list.php?list&delivered&order_id='.$row['order_id'].'&pickup='.$pickup.'&del='.$delivered.'" onclick="return delConfirmation();">Delivered</a>';
                                echo '</div>';

                                if(isset($_GET['delivered']))
                                {
                                    $or_id = $_GET['order_id'];

                                    $query = "UPDATE pizza_order SET delivered = '1' WHERE order_id = '$or_id'";
                                    mysqli_query($connect, $query);
                                    
                                    ?>
                                    <script>
                                        alert("Order delivered sucessfully!");
                                        window.location.href = "accept_list.php";
                                    </script>
                                    <?php
                                }
                            }
                            
                        }
                    echo '</div>';
               
            }
        }
    }
    else
    {
        echo '<div class="order_empty">';
        echo 'No Order Accepted!';
        echo '</div>';
    }
    echo '</div>';
    mysqli_close($connect);
?>
</body>
</html>