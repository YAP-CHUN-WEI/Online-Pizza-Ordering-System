<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main_status.css">

</head>
<body>
    <div class="order_list">
    <?php
        $user_id = $_SESSION['uid'];
        $query = "SELECT * FROM pizza_order WHERE user_id = $user_id AND user_confirmation = '0' AND payment_status = '1'";
        $result = mysqli_query($connect, $query);

        while($row = mysqli_fetch_assoc($result))
        {   
            echo '<a class="order_content" href="pizza_status.php?back&order_id='.$row['order_id'].'">';
            echo 'Order Time: '.$row['purchase_time'];
            echo '</a>';
        } 
    ?>
    </div>
   

</body>
</html>