<?php
session_start();
if (!isset($_SESSION["username"])){   // neu chua dang nhap thi tro ve login 
    header("Location: login.php");
    exit();
}
$products = [
  1 => ['name' => 'Laptop', 'price' => 1500],
  2 => ['name' => 'Mouse', 'price' => 20],
  3 => ['name' => 'Keyboard', 'price' => 35]
];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1></h1>Welcome to the Store, <?php echo $_SESSION["username"]; ?>!</h1>
    <h2>Product List</h2>
    <table border="1" cellpadding="10">
        <tr>
            <th>Product</th>
            <th>Price ($)</th>
            <th>Action</th>
        </tr>
        <?php foreach ($products as $id => $p): ?>
        <tr>
            <td><?php echo $p['name']; ?></td>
            <td><?php echo $p['price']; ?></td>
            <td><a href="cart.php?action=add&id=<?php echo $id; ?>">Add to Cart</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="cart.php">🛒 View Cart</a> |
    <a href="logout.php">Logout</a>
</body>
</html>