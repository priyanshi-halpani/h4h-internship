<?php
require_once "db.php";

$id = (int) $_GET["id"];

$stmt = $conn->prepare("SELECT * FROM orders WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$order = $result->fetch_assoc();

if (!$order) {
    die("Order not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Order</title>
</head>

<body>

<h1>Edit Order</h1>

<form method="POST" action="index.php">

    <input type="hidden" name="id"
           value="<?= htmlspecialchars($order["id"]) ?>">

    <input type="text" name="name"
           value="<?= htmlspecialchars($order["name"]) ?>"
           required>

    <input type="text" name="coffee_name"
           value="<?= htmlspecialchars($order["coffee_name"]) ?>"
           required>

    <input type="number" name="quantity"
           value="<?= htmlspecialchars($order["quantity"]) ?>"
           min="1"
           required>

    <button type="submit" name="update">Update Order</button>

</form>

<a href="index.php">Back to Orders</a>

</body>
</html>