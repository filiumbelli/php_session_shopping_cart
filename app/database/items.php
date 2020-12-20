<?php
if (!isset($_SESSION)) {
    session_start();
}
$items = [
    [
        'id'=>1,
        'title' => 'Latest Item',
        'price' => 29.90,
        'description' => "The latest items with perfect descriptions.",
    ],
    [
        'id'=>2,
        'title' => 'Another Item',
        'price' => 15.90,
        'description' => "The another items with great descriptions.",
    ],
    [
        'id'=>3,
        'title' => 'Professional Item',
        'price' => 49.50,
        'description' => "The professional items with amazing descriptions.",
    ],

];

$_SESSION['items'] = $items;
if(!isset($_SESSION['cart_item'])){
    $_SESSION['cart_item'] = [];
}