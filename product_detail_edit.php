<?php
include("dbconnection.php");
include("admin_nav.php");

if (isset($_GET['id'])) {
    $prod_id = $_GET['id'];
    $prod_price = number_format($_GET['price'], 2);
    $prod_category = $_GET['category'];
    $query = "SELECT * FROM product WHERE product_id = $prod_id";
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_assoc($result);

    $query2 = "SELECT * FROM pizza_crust";
    $result2 = mysqli_query($connect, $query2);

    $query3 = "SELECT * FROM pizza_size";
    $result3 = mysqli_query($connect, $query3);

    $query4 = "SELECT * FROM pizza_topping";
    $result4 = mysqli_query($connect, $query4);
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="product_detail_edit.css">
    <title>Admin Product Detail</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .hidden {
            display: none;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            margin-top: 10px;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: red;
        }
    </style>
    <script>
        function editSize() {
            var newSpace = document.getElementById("newSpace");
            newSpace.classList.toggle("hidden");
        }

        function editTopping() {
            var newSpace = document.getElementById("newSpace2");
            newSpace.classList.toggle("hidden");
        }

        function editCrust() {
            var newSpace = document.getElementById("newSpace3");
            newSpace.classList.toggle("hidden");
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

        echo '<form name="edit_form" method="post">';
        echo '<ul>';
        echo '<li>Size : ';
        echo '<div class="select-container">';
        echo '<select name="size">';
        while ($row3 = mysqli_fetch_assoc($result3)) {
            echo '<option value="'.$row3["size_ID"].'">'.$row3["size_name"].' (+RM '.$row3['size_price'].')'.'</option>';
        }
        echo '</select>';
        echo '<button type="button" class="edit-button" onclick="editSize()">Edit</button>';
        echo '</div>';
        echo '<div id="newSpace" class="hidden">';
        echo '<p>Add new size:</p>';
        echo '<input type="text" name="new_size" >';
        echo '<p>Price:</p>';
        echo '<input type="number" name="size_Price" step="0.01" placeholder="0.00">';
        echo '<input type="submit" value="Save" name="saveSize">';
        echo '</div>';
        echo '</li>';

        if (isset($_POST["saveSize"])) {
            $size = $_POST["new_size"];
            $price = $_POST["size_Price"];

            $editSize = "INSERT INTO pizza_size(size_name,size_price)VALUES('$size','$price')";
            mysqli_query($connect, $editSize);
            echo '<meta http-equiv="refresh" content="0;URL=product_detail_edit.php?details&id='.$row['product_id'].'&price='.$row['product_price'].'&category='.$row['product_category'].'">';
        }

        echo '<li>Toppings : ';
        echo '<div class="select-container">';
        echo '<select name="toppings">';
        while ($row4 = mysqli_fetch_assoc($result4)) {
            echo '<option value="'.$row4['topping_ID'].'">'.$row4['topping_name'].' (+RM '.$row4['topping_price'].')'.'</option>';
        }
        echo '</select>';
        echo '<button type="button" class="edit-button" onclick="editTopping()">Edit</button>';
        echo '</div>';

        echo '<div id="newSpace2" class="hidden">';
        echo '<p>Add new topping:</p>';
        echo '<input type="text" name="new_topping">';
        echo '<p>Price:</p>';
        echo '<input type="number" name="topping_Price" step="0.01" placeholder="0.00">';
        echo '<input type="submit" value="Save" name="saveTopping">';
        echo '</div>';
        echo '</li>';

        if (isset($_POST["saveTopping"])) {
            $topping = $_POST["new_topping"];
            $price = $_POST["topping_Price"];

            $editTopping = "INSERT INTO pizza_topping(topping_name,topping_price)VALUES('$topping','$price')";
            mysqli_query($connect, $editTopping);
            echo '<meta http-equiv="refresh" content="0;URL=product_detail_edit.php?details&id='.$row['product_id'].'&price='.$row['product_price'].'&category='.$row['product_category'].'">';
        }

        echo '<li>Crust : ';
        echo '<div class="select-container">';
        echo '<select name="crust">';
        while ($row2 = mysqli_fetch_assoc($result2)) {
            echo '<option value="'.$row2['crust_ID'].'">'.$row2['crust_name'].' (+RM '.$row2['crust_price'].')'.'</option>';
        }
        echo '</select>';
        echo '<button type="button" class="edit-button" onclick="editCrust()" >Edit</button>';
        echo '</div>';
        echo '<div id="newSpace3" class="hidden">';
        echo '<p>Add new crust:</p>';
        echo '<input type="text" name="new_crust">';
        echo '<p>Price:</p>';
        echo '<input type="number" name="crust_Price" step="0.01" placeholder="0.00">';
        echo '<input type="submit" value="Save" name="saveCrust">';
        echo '</div>';
        echo '</li>';

        if (isset($_POST["saveCrust"])) {
            $crust = $_POST["new_crust"];
            $price = $_POST["crust_Price"];

            $editCrust = "INSERT INTO pizza_crust(crust_name,crust_price)VALUES('$crust','$price')";
            mysqli_query($connect, $editCrust);
            echo '<meta http-equiv="refresh" content="0;URL=product_detail_edit.php?details&id='.$row['product_id'].'&price='.$row['product_price'].'&category='.$row['product_category'].'">';
        }

        echo '</ul>';
        echo'<input class="submitbtn" type="button" value="Go back!" onclick="history.back()">';
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
