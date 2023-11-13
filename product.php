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
                    <p>Shopper: <span id="nameOutput"></span></p>
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

    <!-- Product Details Section -->
    <div class="product-page">
        <?php
        include 'store.php';
        include 'phpqrcode/qrlib.php';

        // Retrieve the 'id' parameter from the URL
        $productId = isset($_GET['id']) ? $_GET['id'] : null;

        if ($productId !== null) {
            // Check if the specified product ID exists in the products array
            if (isset($products[$productId])) {
                $product = $products[$productId];
                echo "<div class='product-page-image'>
                        <img src='{$product['image_url']}' alt='Product Image' loading='lazy'>
                    </div>";

                    echo "<div class='product-page-card'>
                    <h1>{$product['name']}</h1>
                    <p id='pid'>{$product['id']}</p>
                    <br>
                    <p>Price: \${$product['price']}</p>
                    <br>
                    <p>{$product['description']}</p>
                    <br>
                    <p id='stock'>Stock: {$product['quantity_available']}</p>
                    <br>
                    <label for='quantity'>Quantity</label>
                    <input type='number' id='quantity' name='quantity' min='1' max='100' value='1'>
                    <br>
                    <button class='ppage-btn' id='atc-btn'>Add to Cart</button>
                    <br>
                    <div id='error-message'></div>
                    
                    <!-- Add an image tag for the QR code -->
                    <img src='generate_qr_code.php?id={$product['id']}' alt='QR Code' />
                </div>";                  
            } else {
                echo "<p>Product not found</p>";
            }
        } else {
            echo "<p>Product ID not specified</p>";
        }
        ?>
    </div>

    <footer>
        <div class="footer-content"></div>
    </footer>

    <script src="script2.js"></script>
</body>
</html>