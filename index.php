<?php
require_once('common.php');

initCart();

if (isset($_REQUEST['id']) && !in_array($_REQUEST['id'], $_SESSION['cart'])) {
    $_SESSION['cart'][] = $_REQUEST['id'];
    header('Location: /index.php');
    die;
}

if (!count($_SESSION['cart'])) {
    $sql = $pdo->query('SELECT * FROM products');
} else {
    $ids = implode(',', $_SESSION['cart']);
    $sql = $pdo->query('SELECT * FROM products WHERE id NOT IN (' . $ids . ')');
}

print_r($_SESSION['cart']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= translate('Index') ?></title>
    <style>
        td {
            width: 150px;
            border: 1px solid #000;
            height: 50px;
        }
    </style>
</head>
<body>
<table>
    <?php while ($row = $sql->fetch()) : ?>
        <tr>
            <td>
                <h3><?= $row['image'] ? $row['image'] : translate('No image') ?></h3>
            </td>
            <td>
                <h3><?= $row['title'] ? $row['title'] : translate('No title') ?></h3>
                <h3><?= $row['description'] ? $row['description'] : translate('No description') ?></h3>
                <h3><?= $row['price'] ? $row['price'] : translate('No price') ?></h3>
            </td>
            <td>
                <a href="index.php?id=<?= $row['id'] ?>"><?= translate('Add') ?></a>
            </td>
        </tr>
    <?php endwhile ?>
</table>
<br>
<a href="cart.php"><?= translate('Go to cart') ?></a>
</body>
</html>




