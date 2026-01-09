<!DOCTYPE html>
<html>
<head>
    <title>Admin Product List</title>
    <link rel="stylesheet" href="admin_product_list.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        include("admin_session.php");
        include("admin_nav.php");
    ?>
</head>
</style>
<body>
    <div class="category" id="original">

        <div onclick='location.href="#meat"'>
            <p>Meat</p>
        </div>
 
        <div onclick='location.href="#seafood"'>
            <p>Seafood</p>
        </div>
        <div onclick='location.href="#vegetarian"'>
            <p>Vegetarian</p>
        </div>
    </div>
    
    <?php
        include("dbconnection.php");
        /*
            Remember the link of the menu (not the edit menu) which link to the product details, later can make it link to the edit product
            details page for admin only!!!
        */
    ?>
    <div class="categoryWord" id="meat" onclick='location.href="#original"'>
            <p>Meat</p>
    </div>

    <?php    
        $image_details = mysqli_query($connect,"SELECT * FROM product");
        $admin_id = $_SESSION['adminID'];
        echo $admin_id;
        while($row = mysqli_fetch_array($image_details))
        {              
            if($row['product_category'] == 'meat' && $row['available'] == '1')
            {   
                echo '<div class = "list">';
                    echo '<div class = "table">';
                        echo '<div class = "table_content">';
                            ?>
                                <a href="<?php echo 'product_detail_edit.php?details&id='.$row['product_id'].'&price='.$row['product_price'].'&category='.$row['product_category'] ?>" style="text-decoration: none;">
                            <?php
                                echo "<img src='img/".$row['product_name'].'.jpg'.'?t='.time()."' >";
                                echo '<div class = "pizzName">';
                                    echo $row['product_name'];
                                echo '</div>';
                                echo '<div class = pizzPrice>';
                                    echo 'RM '.$row['product_price'];
                                echo '</div>';
                                echo '<p class = pizzRating>';
                                    echo 'Rating : '.$row['product_rating'].' / 5';
                                echo '</p>';
                            ?>
                                </a>
                            <?php
                        echo '</div>';

                        echo "<a  class= 'edit' href='edit_product.php".'?edit&id='.$row['product_id'].'&category='.$row['product_category']."'>";
                            echo 'Edit';
                        echo '</a>';

                    echo '</div>';
                echo '</div>';
            }
            elseif($row['product_category'] == 'meat' && $row['available'] == '0')
            {
                echo '<div class = "list">';
                    echo '<div class = "table">';
                        echo '<div class = "table_content_unavailable">';  
                                echo "<img src='img/".$row['product_name'].'.jpg'.'?t='.time()."' >";

                                echo '<div class="unavailable_img">';
                                echo 'Not Available';
                                echo '</div>';

                                echo '<div class = "pizzName">';
                                    echo $row['product_name'];
                                echo '</div>';
                                echo '<div class = pizzPrice>';
                                    echo 'RM '.$row['product_price'];
                                echo '</div>';
                                echo '<p class = pizzRating>';
                                    echo 'Rating : '.$row['product_rating'].' / 5';
                                echo '</p>';
                        echo '</div>';

                        echo "<a  class= 'edit' href='edit_product.php".'?edit&id='.$row['product_id'].'&category='.$row['product_category']."'>";
                            echo 'Edit';
                        echo '</a>';

                    echo '</div>';
                echo '</div>';
            }
        }
    ?>

    <div class="categoryWord" id="seafood" onclick='location.href="#original"'>
            <p>Seafood</p>
    </div>

    <?php    
        $image_details = mysqli_query($connect,"SELECT * FROM product");
        while($row = mysqli_fetch_array($image_details))
        {   
            if($row['product_category'] == 'seafood' && $row['available'] == '1')
            {
                echo '<div class = "list">';
                    echo '<div class = "table">';
                        echo '<div class = "table_content">';
                        ?>
                            <a href="<?php echo 'product_detail_edit.php?details&id='.$row['product_id'].'&price='.$row['product_price'].'&category='.$row['product_category'] ?>" style="text-decoration: none;">
                        <?php
                            echo "<img src='img/".$row['product_name'].'.jpg'.'?t='.time()."' >";
                                echo '<div class = pizzName>';
                                    echo $row['product_name'];
                                echo '</div>';
                                echo '<div class = pizzPrice>';
                                    echo 'RM '.$row['product_price'];
                                echo '</div>';
                                echo '<p class = pizzRating>';
                                    echo 'Rating : '.$row['product_rating'].' / 5';
                                echo '</p>';
                        ?>
                            </a>
                        <?php
                        echo '</div>';

                        echo "<a  class= 'edit' href='edit_product.php".'?edit&id='.$row['product_id'].'&category='.$row['product_category']."'>";
                            echo 'Edit';
                        echo '</a>';

                    echo '</div>';
                echo '</div>';
            }
            elseif($row['product_category'] == 'seafood' && $row['available'] == '0')
            {
                echo '<div class = "list">';
                    echo '<div class = "table">';
                        echo '<div class = "table_content_unavailable">';  
                                echo "<img src='img/".$row['product_name'].'.jpg'.'?t='.time()."' >";

                                echo '<div class="unavailable_img">';
                                echo 'Not Available';
                                echo '</div>';

                                echo '<div class = "pizzName">';
                                    echo $row['product_name'];
                                echo '</div>';
                                echo '<div class = pizzPrice>';
                                    echo 'RM '.$row['product_price'];
                                echo '</div>';
                                echo '<p class = pizzRating>';
                                    echo 'Rating : '.$row['product_rating'].' / 5';
                                echo '</p>';
                        echo '</div>';

                        echo "<a  class= 'edit' href='edit_product.php".'?edit&id='.$row['product_id'].'&category='.$row['product_category']."'>";
                            echo 'Edit';
                        echo '</a>';

                    echo '</div>';
                echo '</div>';
            }
        }
    ?>

    <div class="categoryWord" id="vegetarian" onclick='location.href="#original"'>
            <p>Vegetarian</p>
    </div>

    <?php    
        $image_details = mysqli_query($connect,"SELECT * FROM product");
        while($row = mysqli_fetch_array($image_details))
        {   
            if($row['product_category'] == 'vegetarian' && $row['available'] == '1')
            {
                echo '<div class = "list">';
                    echo '<div class = "table">';
                        echo '<div class = "table_content">';
                        ?>
                            <a href="<?php echo 'product_detail_edit.php?details&id='.$row['product_id'].'&price='.$row['product_price'].'&category='.$row['product_category'] ?>" style="text-decoration: none;">
                        <?php
                            echo "<img src='img/".$row['product_name'].'.jpg'.'?t='.time()."' >";
                                echo '<div class = pizzName>';
                                    echo $row['product_name'];
                                echo '</div>';
                                echo '<div class = pizzPrice>';
                                    echo 'RM '.$row['product_price'];
                                echo '</div>';
                                echo '<p class = pizzRating>';
                                    echo 'Rating : '.$row['product_rating'].' / 5';
                                echo '</p>';
                        ?>
                            </a>
                        <?php
                        echo '</div>';

                        echo "<a  class= 'edit' href='edit_product.php".'?edit&id='.$row['product_id'].'&category='.$row['product_category']."'>";
                            echo 'Edit';
                        echo '</a>';

                    echo '</div>';
                echo '</div>';
            }
            elseif($row['product_category'] == 'vegetarian' && $row['available'] == '0')
            {
                echo '<div class = "list">';
                    echo '<div class = "table">';
                        echo '<div class = "table_content_unavailable">';  
                                echo "<img src='img/".$row['product_name'].'.jpg'.'?t='.time()."' >";

                                echo '<div class="unavailable_img">';
                                echo 'Not Available';
                                echo '</div>';

                                echo '<div class = "pizzName">';
                                    echo $row['product_name'];
                                echo '</div>';
                                echo '<div class = pizzPrice>';
                                    echo 'RM '.$row['product_price'];
                                echo '</div>';
                                echo '<p class = pizzRating>';
                                    echo 'Rating : '.$row['product_rating'].' / 5';
                                echo '</p>';
                        echo '</div>';
                            echo "<a  class= 'edit' href='edit_product.php".'?edit&id='.$row['product_id'].'&category='.$row['product_category']."'>";
                                echo 'Edit';
                            echo '</a>';
                    echo '</div>';
                echo '</div>';
            }
        }
    ?>

    </div>  
        <a class="back" href="#" style="text-decoration: none;">
            <div>
                Back to top
            </div>
        </a>
    </div>

    <?php
        mysqli_close($connect);
    ?>
</body>
</html>