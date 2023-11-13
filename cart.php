<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Assignment 1 - Ian McDonald</title>
    <meta name="description" content="Assignment 1">
    <meta name="keywords" content="COMP1230">
    <meta name="author" content="Ian McDonald">
    <link rel="stylesheet" href="./assets/css/styles.css">
</head>
<body>
    <div class="user-info">
        <nav>
            <div class="display-info">
                <div id="nameOutputDiv">
                    <p>Shopper Name: <span id="nameOutput"></span></p>
                </div>

                <div id="studentIDOutputDiv">
                    <p>Student ID: <span id="studentIDOutput"></span></p>
                </div>
            </div>
            
            <div class="nav-title">
                <h1>The George Store</h1>
            </div>
    
            <button id="cart" class="cart" onclick="window.location.href='cart.php'">
                <img src="./assets/images/cart.png" alt="cart" style="height: 30px; width: 30px;">
                <span class="badge" id="badge"></span>
            </button>
        </nav>
    </div>

    <div>
        <button class="back-btn" id="back-btn" onclick="window.location.href='index.php'">Back</button>
    </div>

    <div class="cart">
        <h1 class="cart-heading">Cart</h1>
        <div class="cartResults" id="cartResults">
            <div class="cart-products">
            <?php
            require 'store.php';

            // Load the cart data from the cookie
            $cartData = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];

            // Create a function to get product details based on product ID
            function getProductDetails($productId, $products) {
                foreach ($products as $product) {
                    if ($product['id'] == $productId) {
                        return $product;
                    }
                }
                return null; // Product not found
            }

            // Initialize variables to calculate subtotal and total
            $subtotal = 0;
            $taxRate = 0.13; // Change this to your tax rate

            // Display the cart products
            foreach ($cartData as $cartItem):
                $productId = $cartItem['productId'];
                $quantity = $cartItem['quantity'];

                // Get product details based on product ID
                $product = getProductDetails($productId, $products);

                if ($product !== null):
                    $productSubtotal = $product['price'] * $quantity;
                    $subtotal += $productSubtotal;
                ?>
                    <div class="cart-product-card">
                        <div class="cart-product">
                            <h3><?php echo $product['name']; ?></h3>
                            <br>
                            <img src="<?php echo $product['image_url']; ?>" alt="product image">
                            <br>
                            <p>$<?php echo $product['price']; ?> CAD</p>
                            <br>
                            <p id="sale-item">Sale: <?php echo '$' . $product['sale_price']; ?></p>
                            <br>
                            <p>Quantity: <?php echo $quantity; ?></p>
                            <br>
                        </div>
                    </div>
                <?php
                    endif;
                endforeach;
                ?>
            </div>
            <div class="cart-info">
                <h2>Subtotal</h2>
                <p id="cart-subtotal">$<?php echo number_format($subtotal, 2); ?> CAD</p>
                <br>
                <h2>Total</h2>
                <?php
                $tax = $subtotal * $taxRate;
                $total = $subtotal + $tax;
                ?>
                <p id="cart-total">$<?php echo number_format($total, 2); ?> CAD</p>
            </div>
        </div>
    </div>

    <footer>
        <div class="footer-content"></div>
    </footer>

    <script src="store.php"></script>
    <script src='script2.js'></script>
</body>
</html>