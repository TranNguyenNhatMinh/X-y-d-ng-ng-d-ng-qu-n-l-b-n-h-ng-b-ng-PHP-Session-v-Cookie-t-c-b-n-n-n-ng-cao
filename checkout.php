<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (empty($_SESSION['cart'])) {
    echo "Your cart is empty! <a href='store.php'>Go shopping</a>";
    exit();
}

// Mảng sản phẩm (giống các file trước)
$products = [
    1 => ['name' => 'Laptop', 'price' => 1500],
    2 => ['name' => 'Mouse', 'price' => 20],
    3 => ['name' => 'Keyboard', 'price' => 35]
];

// Tính tổng tiền
$total = 0;
foreach ($_SESSION['cart'] as $id => $qty) {
    $total += $products[$id]['price'] * $qty;
}

// Khi người dùng xác nhận thanh toán
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_SESSION['username'];
    $log = "User: $username | Total: $total USD | Time: " . date('Y-m-d H:i:s') . "\n";

    // Ghi log ra file
    file_put_contents('orders.txt', $log, FILE_APPEND);

    // Dọn session
    session_unset();
    session_destroy();

    header("Location: logout.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
</head>
<body>
    <h2>Checkout</h2>
    <p>Hello, <strong><?php echo $_SESSION['username']; ?></strong></p>
    <p>Total payment: <strong><?php echo $total; ?> USD</strong></p>

    <form method="POST">
        <input type="submit" value="Confirm Payment">
    </form>
</body>
</html>
