<?php
session_start();

// Mảng sản phẩm (giống store.php)
$products = [
    1 => ['name' => 'Laptop', 'price' => 1500],
    2 => ['name' => 'Mouse', 'price' => 20],
    3 => ['name' => 'Keyboard', 'price' => 35]
];

// Khởi tạo giỏ hàng nếu chưa có
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Xử lý hành động
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    // Thêm sản phẩm
    if ($action === 'add' && isset($_GET['id'])) {
        $id = $_GET['id'];
        if (isset($products[$id])) {
            if (!isset($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id] = 1;
            } else {
                $_SESSION['cart'][$id]++;
            }
        }
        header("Location: cart.php");
        exit();
    }

    // Xóa sản phẩm
    if ($action === 'remove' && isset($_GET['id'])) {
        unset($_SESSION['cart'][$_GET['id']]);
        header("Location: cart.php");
        exit();
    }

    // Cập nhật số lượng
    if ($action === 'update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        foreach ($_POST['qty'] as $id => $qty) {
            if ($qty <= 0) {
                unset($_SESSION['cart'][$id]);
            } else {
                $_SESSION['cart'][$id] = $qty;
            }
        }
        header("Location: cart.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart</title>
</head>
<body>
    <h2>Your Shopping Cart</h2>

    <?php if (empty($_SESSION['cart'])): ?>
        <p>Your cart is empty.</p>
    <?php else: ?>
        <form method="POST" action="cart.php?action=update">
            <table border="1" cellpadding="10">
                <tr>
                    <th>Product</th>
                    <th>Price ($)</th>
                    <th>Quantity</th>
                    <th>Subtotal ($)</th>
                    <th>Action</th>
                </tr>
                <?php
                $total = 0;
                foreach ($_SESSION['cart'] as $id => $qty):
                    $p = $products[$id];
                    $subtotal = $p['price'] * $qty;
                    $total += $subtotal;
                ?>
                <tr>
                    <td><?php echo $p['name']; ?></td>
                    <td><?php echo $p['price']; ?></td>
                    <td><input type="number" name="qty[<?php echo $id; ?>]" value="<?php echo $qty; ?>" min="1"></td>
                    <td><?php echo $subtotal; ?></td>
                    <td><a href="cart.php?action=remove&id=<?php echo $id; ?>">Remove</a></td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3" align="right"><strong>Total:</strong></td>
                    <td colspan="2"><strong><?php echo $total; ?> $</strong></td>
                </tr>
            </table>
            <br>
            <input type="submit" value="Update Cart">
        </form>

        <br>
        <a href="store.php">🛍 Continue Shopping</a> |
        <a href="checkout.php">💳 Checkout</a>
    <?php endif; ?>
</body>
</html>
