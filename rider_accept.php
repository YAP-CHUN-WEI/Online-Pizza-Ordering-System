<!DOCTYPE html>
<html>
<head>
    <title>Rider Accept</title>
    <link rel='stylesheet' type='text/css' href='rider_accept.css'>

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
</script>
<?php
    
    $rider_id = $_SESSION['riderID'];

    $query = "SELECT * FROM pizza_order WHERE rider_id = '0' AND pickup = '0' AND delivered = '0' AND user_confirmation = '0' AND payment_status = '1'";
    $result = mysqli_query($connect, $query);

    echo '<div class="content">';
    echo '<div class="my_list">Order List</div>';
    
    if(mysqli_num_rows($result)>0)
    {   
        while($row = mysqli_fetch_assoc($result))
        {
            echo '<a class="order" href="rider_accept.php?accept&order_id='.$row['order_id'].'" onclick="return confirmation();" style="text-decoration: none;">';
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
        }
    }
    else
    {
        echo '<div class="order_empty">';
        echo 'No Order Currently!';
        echo '</div>';
    }
    echo '</div>';

    if(isset($_GET['accept']))
    {   
        $order_id = $_GET['order_id'];
        $query = "UPDATE pizza_order SET rider_id = '$rider_id' WHERE order_id = '$order_id'";

        if (mysqli_query($connect, $query))
        {
            ?>
            <script>
                alert("Order accepted successfully!");
                window.location.href = 'rider_accept.php';
            </script>
            <?php   
        }
        
    }
    mysqli_close($connect);
?>
</body>
</html>