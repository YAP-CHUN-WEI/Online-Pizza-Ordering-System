<!DOCTYPE html>
<html>
<head>
    <title>Product Detail - POS</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="confirmation.css">
    <?php 
      session_start();
      include("admin_nav.php")
    ?>
</head>
<body>

<main>
  <h2>Order Summary</h2>
  <table>
    <thead>
      <tr>
        <th>Image</th>
        <th>Name</th>
        <th>Size</th>
        <th>Toppings</th>
        <th>Crust</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><img src="Img/Mare Monti.jpg" alt="Pizza Image" width="150"></td>
        <td>
          <div class="pizza-details">
            <div class="pizza-name">Mare Monti</div>
            <div class="pizza-size">Large</div>
            <div class="pizza-toppings">Pepperoni</div>
            <div class="pizza-crust">Thin</div>
            <div class="pizza-quantity">1</div>
            <div class="pizza-price">RM 17</div>
          </div>
        </td>
        <td>
          <div class="actions">
            <button onclick="confirmOrder(this)">Confirm</button>
            <button onclick="deleteOrder(this)">Delete</button>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</main>
</body>
</html>
