<!DOCTYPE html>
<html>
<head>
    <title>Edit Menu</title>
    <link rel="stylesheet" href="edit_product.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        include("admin_session.php");
        include("admin_nav.php"); 
    ?>
</head>
<script>
    function getCurrentURL () 
    {
        return window. location. href;
    }

    const url = getCurrentURL();
</script>
<body>
<?php 
    if(isset($_GET["edit"]))
    {
        include("dbconnection.php");
        $prod_id = $_GET['id'];
        $prod_category = $_GET['category'];
		$query = "SELECT * FROM product WHERE product_id = $prod_id";
		$result = mysqli_query($connect, $query);
		$row = mysqli_fetch_assoc($result);
    }

    echo '<div class = "list">';
        echo '<div class = "table">';
            echo '<form class="box" name="edit_form" method="post" action="">';       
            echo '<div class = "table_content">';      
                echo "<img src='img/".$row['product_name'].'.jpg'.'?t='.time()."' >";
                echo '<div class = "pizzName">';
                    echo $row['product_name'];
                echo '</div>';
                echo '<div class = pizzPrice>';
                    echo 'RM<input type="text" name="prod_price" size="2" value='.$row['product_price'].'>';
                echo '</div>';
                echo '<p class = pizzRating>';
                    echo 'Rating : <input type="number" name="prod_rating" step="any" min="0.1" max="5" size="2" value='.$row['product_rating'].'> / 5';
                echo '</p>';
                echo '<p class="pizzAvailable">';
                    echo 'Availability<span style="color:blue;">*</span> : <input type="radio" required id="yes" name="prod_ava" value="1">';
                    echo '<label for="yes">YES</label>';
                    echo '&nbsp&nbsp<input type="radio" id="no" name="prod_ava" value="0">';
                    echo '<label for="no">NO</label>';
                echo '</p>';                      
            echo '</div>';
            echo '<div class = submit_btn>';
                    echo '<input type="submit" name="save_btn" value="Update">';
            echo '</div>';
            echo '</form>';
        echo '</div>';
    echo '</div>';

    if(isset($_POST["save_btn"]))
    {   
            $pprice = $_POST["prod_price"];
            $prating = $_POST["prod_rating"];
            $pava = $_POST["prod_ava"];

            $query = "UPDATE product SET product_price = '$pprice', product_rating = '$prating', available = '$pava' WHERE product_id = $prod_id";
            $result = mysqli_query($connect, $query);
            ?>
                <script>
                    alert("Pizza updated sucessfully !");
                </script>
            <?php
            header("refresh: 0.2; url = admin_product_list.php#$prod_category");                           
    }
    mysqli_close($connect);
?>
</body>
</html>