<?php
    require ('common.php');
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    $sql = $pdo->query('SELECT * FROM products');
    if($_GET['action']=="delete") {
         $id = $_GET['id'];
         $delete = $pdo->query('DELETE FROM products WHERE id IN ('.$id.')');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= translate('Cart') ?></title>
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
            <?php if (array_key_exists($row['id'], $_SESSION['cart'])) : ?>
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
                        <a href="cart.php?action=delete&id=<?= $row['id'] ?>"><? translate('Remove') ?></a>
                    </td>
                </tr>
            <?php endif ?>
        <?php endwhile ?>
    </table>
    <br>
    <a href="index.php"><?= translate('Go to index') ?></a>
</body>
</html>
