<!DOCTYPE html>
<html>
<head>
    <title>Sales Report</title>
    <link rel='stylesheet' type='text/css' href='sales_report.css'>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php 
        include("dbconnection.php");
        include("admin_nav.php");//need a nav for rider
    ?>
</head> 
<body>
<?php
    // $query = "SELECT pizza_order.order_id, pizza_order.total_price, pizza_order.user_id, pizza_order.customer_name, pizza_order.customer_phone,
    //                  pizza_order.customer_address, pizza_order.payment, pizza_order.purchase_date, pizza_order.purchase_time, pizza_order.rider_id, 
    //                  pizza_order.pickup, pizza_order.delivered, pizza_order.user_confirmation, pizza_order.payment_status, 
    //                  rider.rider_ID, rider.rider_username, rider.rider_password
    //           FROM pizza_order INNER JOIN rider ON pizza_order.rider_id = rider.rider_ID";
    // $query = "SELECT * FROM pizza_order INNER JOIN rider ON pizza_order.rider_id = rider.rider_ID";
    $query = "SELECT * FROM pizza_order";
    $result = mysqli_query($connect, $query);

    echo '<div class="content">';
    if(mysqli_num_rows($result)>0)
    {   
        while($row = mysqli_fetch_assoc($result))
        {
            echo '<a class="order" href="sales_report.php?list&order_id='.$row['order_id'].'&pickup='.$row['pickup'].'&del='.$row['delivered'].'"  style="text-decoration: none;">';
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

                        echo '<div class="status">';
                            if($row['rider_id'] == 0)
                            {   
                                echo '<div class="cancel">';
                                echo 'No rider!';
                                echo '</div>';
                                echo '<br>';
                            }
                            else
                            {
                                echo 'Rider ID: '.$row['rider_id'].'<br>';
                            }   
                            
                            if($row['pickup'] == 1)
                            {   
                                echo 'Pickup: ';
                                echo '<div class="successful">';
                                    echo 'Yes !';
                                echo '</div>';
                                echo '<br>';
                            }
                            else if($row['pickup'] == 0)
                            {   
                                echo 'Pickup: ';
                                echo '<div class="cancel">';
                                    echo 'No !';
                                echo '</div>';
                                echo '<br>';
                            }
                            
                            if($row['delivered'] == 1)
                            {   
                                echo 'Delivered: ';
                                echo '<div class="successful">';
                                    echo 'Yes !';
                                echo '</div>';
                                echo '<br>';
                            }
                            else if($row['delivered'] == 0)
                            {   
                                echo 'Delivered: ';
                                echo '<div class="cancel">';
                                    echo 'No !';
                                echo '</div>';
                                echo '<br>';
                            }

                            if($row['user_confirmation'] == 1)
                            {   
                                echo 'User confirmation: ';
                                echo '<div class="successful">';
                                    echo 'Yes !';
                                echo '</div>';
                                echo '<br>';
                            }
                            else if($row['user_confirmation'] == 0)
                            {   
                                echo 'User confirmation: ';
                                echo '<div class="cancel">';
                                    echo 'No !';
                                echo '</div>';
                                echo '<br>';
                            }
                            

                            if($row['payment_status'] == 1)
                            {   
                                echo 'Payment status: ';
                                echo '<div class="successful">';
                                    echo 'Sucessful !';
                                echo '</div>';
                            }
                            else if($row['payment_status'] == 0)
                            {   
                                echo 'Payment status: ';
                                echo '<div class="cancel">';
                                    echo 'Cancelled !';
                                echo '</div>';
                            }
                        echo '</div>';
                    echo '</div>';
            }
        }
    }
    else
    {
        echo '<div class="order_empty">';
        echo 'The Order Is Empty!';
        echo '</div>';
    }
    echo '</div>';
    mysqli_close($connect);
    
?>
</body>
</html>