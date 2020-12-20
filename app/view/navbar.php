<?php
if (!isset($_SESSION)) {
    session_start();
} ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <div class="navbar-nav mr-auto mt-2 mt-lg-0">
            <a href="#" class="navbar-brand " style="color:cornflowerblue">Home</a>
        </div>
        <div class="my-2 my-lg-0">
            <span class="cart_number"><?= isset($_SESSION['cart_item']) ? count($_SESSION['cart_item']) : 0; ?></span>
            <a href="">
                <i class="fas fa-shopping-cart fa-2x mr-5"></i>
            </a>

        </div>
    </div>
</nav>