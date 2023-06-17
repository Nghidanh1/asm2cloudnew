<?php
// Start the session
session_start();

// Check if the cart is not empty
if(!empty($_SESSION['cart'])) {
    // Get the cart items from the session
    $cartItems = $_SESSION['cart'];

    // Calculate the total price of all items in the cart
    $totalPrice = 0;
    foreach($cartItems as $item) {
        $totalPrice += $item['price'] * $item['quantity'];
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>My Cart</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
	<div class="container">
		<h1>My Cart</h1>
		<table class="table">
			<thead>
				<tr>
					<th>Product Name</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Total Price</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($cartItems as $item) { ?>
				<tr>
					<td><?php echo $item['name']; ?></td>
					<td><?php echo $item['price']; ?></td>
					<td><?php echo $item['quantity']; ?></td>
					<td><?php echo $item['price'] * $item['quantity']; ?></td>
				</tr>
				<?php } ?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="3" align="right">Total:</td>
					<td><?php echo $totalPrice; ?></td>
				</tr>
			</tfoot>
		</table>
		<a href="checkout.php" class="btn btn-primary">Checkout</a>
		<a href="clear-cart.php" class="btn btn-danger">Clear Cart</a>
	</div>
</body>
</html>

<?php
} else {
    // If the cart is empty, display a message
    echo "Your cart is empty.";
}
?>