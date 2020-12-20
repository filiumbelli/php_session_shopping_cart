<?php
if (!isset($_SESSION)) {
    session_start();
}
function isInArray(int $id, array $array)
{
    $value = false;
    foreach ($array as $a) {
        if ($a == $id) {
            $value = true;
        }
    }
    return $value;
}

include_once __DIR__ . "/app/bootstrap.php";
include_once __DIR__ . "/app/view/header.php";
?>

<?php
//$_SESSION['cart_item'] = null;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $request = isset($_REQUEST['submit']) ? 'submit' : 'delete';
    switch ($request) {
        case 'submit':
            $id = $_REQUEST['item_id'];
            $title = $_REQUEST['item_title'];

            $price = $_REQUEST['item_price'];
            if (isset($_SESSION['cart_item'])) {
                $isInArray = isInArray($id, $_SESSION['cart_item']);
                echo $isInArray;
                if ($isInArray) {
                    echo '
                        <div class="container">' .
                        '<h3 class="alert-danger lead">Item is already in the cart</h3>' .
                        "</div>";
                } else {
                    $_SESSION['cart_item'][] = $id;
                    $_SESSION['price'] += $price;
                }
            } else {
                if (!isInArray($id, $_SESSION['cart_item'])) {
                    $_SESSION['cart_item'][] = $id;
                    $_SESSION['price'] = $price;
                }
            }
            break;
        case 'delete':
            if (isset($_SESSION['cart_item'])) {
                $isInArray = isInArray($_REQUEST['item_id'], $_SESSION['cart_item']);
                if ($isInArray == true) {
                    $id = $_REQUEST['item_id'];
                    $index = array_search($id, $_SESSION['cart_item']);
                    $_SESSION['price'] -= $_REQUEST['item_price'];
                    unset($_SESSION['cart_item'][$index]);
                }
            } else {
                header('location:/');
            }
            break;
    }
}
?>

<?php $items = $_SESSION['items']; ?>
<div class="context w-100 h-100 mb-3 ">
    <div class="container">
        <div class="card-group">
            <?php foreach ($items as $item): ?>
                <div class="card">
                    <img src="app/view/images/shopping%20cart.PNG" alt="Image" style="max-width:400px" class="card-img">
                    <div class="card-body font-weight-bolder">
                        <h5 class="card-title text-center"><?= $item['title'] ?> </h5>
                        <p class="card-text">Price: <?= $item['price'] ?> </p>
                        <p><?= $item['description'] ?></p>
                        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                            <input type="submit" name="submit" class="btn btn-primary" value="Add Cart">
                            <input type="hidden" name="item_id" value="<?= $item['id'] ?>">
                            <input type="hidden" name="item_title" value="<?= $item['title'] ?>">
                            <input type="hidden" name="item_price" value="<?= $item['price'] ?>">
                            <input type="submit" name="delete" class="btn btn-danger" value="Delete">
                            <input type="hidden" name="item_id" value="<?= $item['id'] ?>">
                            <input type="hidden" name="item_price" value="<?= $item['price'] ?>">
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

