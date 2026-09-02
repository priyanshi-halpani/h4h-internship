<?php
require_once "db.php";

/* CREATE */
if (isset($_POST["create"])) {
    $name = $_POST["name"];
    $coffee_name = $_POST["coffee_name"];
    $quantity = $_POST["quantity"];

    $stmt = $conn->prepare(
        "INSERT INTO orders (name, coffee_name, quantity) VALUES (?, ?, ?)"
    );
    $stmt->bind_param("ssi", $name, $coffee_name, $quantity);
    $stmt->execute();

    header("Location: index.php");
    exit;
}

/* DELETE */
if (isset($_GET["delete"])) {
    $id = (int) $_GET["delete"];

    $stmt = $conn->prepare("DELETE FROM orders WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    header("Location: index.php");
    exit;
}

/* UPDATE */
if (isset($_POST["update"])) {
    $id = (int) $_POST["id"];
    $name = $_POST["name"];
    $coffee_name = $_POST["coffee_name"];
    $quantity = $_POST["quantity"];

    $stmt = $conn->prepare(
        "UPDATE orders SET name = ?, coffee_name = ?, quantity = ? WHERE id = ?"
    );
    $stmt->bind_param("ssii", $name, $coffee_name, $quantity, $id);
    $stmt->execute();

    header("Location: index.php");
    exit;
}

/* READ */
$result = $conn->query("SELECT * FROM orders ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Orders</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        form {
            margin-bottom: 30px;
        }

        input {
            padding: 10px;
            margin: 5px;
        }

        button {
            padding: 10px 15px;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background: #eee;
        }

        a {
            margin-right: 10px;
        }
    </style>
</head>

<body>

<h1>☕ Coffee Orders</h1>

<h2>Add Order</h2>

<form method="POST">
    <input type="text" name="name" placeholder="Customer name" required>

    <input type="text" name="coffee_name" placeholder="Coffee name" required>

    <input type="number" name="quantity" placeholder="Quantity" min="1" required>

    <button type="submit" name="create">Add Order</button>
</form>

<h2>Orders</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Coffee</th>
        <th>Quantity</th>
        <th>Ordered At</th>
        <th>Actions</th>
    </tr>

<?php while ($row = $result->fetch_assoc()): ?>

    <tr>
        <td><?= htmlspecialchars($row["id"]) ?></td>
        <td><?= htmlspecialchars($row["name"]) ?></td>
        <td><?= htmlspecialchars($row["coffee_name"]) ?></td>
        <td><?= htmlspecialchars($row["quantity"]) ?></td>
        <td><?= htmlspecialchars($row["ordered_at"]) ?></td>

        <td>
            <a href="edit.php?id=<?= $row["id"] ?>">Edit</a>

            <a href="index.php?delete=<?= $row["id"] ?>"
               onclick="return confirm('Delete this order?')">
               Delete
            </a>
        </td>
    </tr>

<?php endwhile; ?>

</table>

</body>
</html>