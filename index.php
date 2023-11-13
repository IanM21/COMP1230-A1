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

    <div class="store">
        <h1 class="store-heading">Store Results</h1>
        <div class="storeResults" id="storeResults">
            <h2 class="sale-heading">Sale Products</h2>
            <div class="sale-products">
                <?php include 'store.php';
                    foreach ($products as &$product) {
                        if ($product['on_sale'] == true) {
                            $discountPercentage = (($product['regular_price'] - $product['sale_price']) / $product['regular_price']) * 100;
                            $product['discount'] = round($discountPercentage, 2);
                        } else {
                            // If not on sale, set discount to 0%
                            $product['discount'] = 0;
                        }
                    }
                    $onSaleProducts = array_filter($products, function (&$product) {
                        return $product['on_sale'] == true;
                    });

                    foreach ($onSaleProducts as $saleProduct): ?>
                    <div class="sale-product-card">
                        <div class="sale-product">
                            <h3><?php echo $saleProduct['name']; ?></h3>
                            <br>
                            <img src="<?php echo $saleProduct['image_url']; ?>" alt="product image">
                            <br>
                            <p>$<?php echo $saleProduct['sale_price']; ?> CAD</p>
                            <br>
                            <p>Stock: <?php echo $saleProduct['quantity_available']; ?></p>
                            <br>
                            <p id="sale-item">Sale: <?php echo '$' . $saleProduct['sale_price']; ?></p>
                            <br>
                            <?php if (isset($saleProduct['regular_price'])): ?>
                                <p id="regular-price">Regular Price: <?php echo '$' . $saleProduct['regular_price']; ?></p>
                            <?php endif; ?>
                            <br>
                            <?php if (isset($saleProduct['discount']) && $saleProduct['discount'] > 0): ?>
                                <p id="discount-price">Discount: <?php echo $saleProduct['discount']; ?>%</p>
                            <?php endif; ?>
                            <br>
                            <br>
                            <label for="quantity">Quantity</label>
                            <input type="number" id="quantity" name="quantity" min="1" max="100" value="1">
                            <br>
                            <button type="button" id="view-product" name="view-product" onclick="window.location.href='product.php?id=<?php echo $saleProduct['id']; ?>'">Visit</button>
                            <br>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <br>

        <div class="storeResults" id="storeResults">
            <h2 class="product-heading">All Products</h2>
            <?php include 'store.php';
                foreach ($products as $product) : ?>
                <div class="product-card">
                    <div class="product">
                        <h3><?php echo $product['name']; ?></h3>
                        <br>
                        <img src="<?php echo $product['image_url']; ?>" alt="product image">
                        <br>
                        <p>$<?php echo $product['price']; ?> CAD</p>
                        <br>
                        <p>Stock: <?php echo $product['quantity_available']; ?></p>
                        <br>
                        <p id="sale-item-r">Sale: <?php echo $product['on_sale'] ? '$' . $product['sale_price'] : 'False'; ?></p>
                        <br>
                        <p id="regular-price">Regular Price: <?php echo isset($product['regular_price']) ? '$' . $product['regular_price'] : null?></p>
                        <br>
                        <label for="quantity">Quantity</label>
                        <input type="number" id="quantity" name="quantity" min="1" max="100" value="1">
                        <br>
                        <button type="button" id="view-product" name="view-product" onclick="window.location.href='product.php?id=<?php echo $product['id']; ?>'">Visit</button>
                        <br>
                        <div id="error-message" style="color: red;"></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>    

    <div class="form-container">
        <h2>Log In</h2>
        <br>
        <form action="store.php" method="post" id="signinForm">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name">
            </div>
            <br>
            <div class="form-group">
                <label for="studentID">Student ID</label>
                <input type="text" id="studentID" name="studentID">
            </div>
            <br>
            <div class="form-group">
                <button type="submit">Submit</button>
            </div>
        </form>        
    </div>

    <footer>
        <div class="footer-content"></div>
    </footer>

    <script src="script.js"></script>
</body>
</html>