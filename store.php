<?php
    // Create products array
    $products = [
        [
            "id" => 0,
            "name" => "White Tee",
            "price" => 9.99,
            "description" => "Classic White Tee Branded",
            "image_url" => "assets/images/white-tee.png",
            "on_sale" => true,
            "regular_price" => 15.99,
            "sale_price" => 9.99,
            "quantity_available" => 10,
        ],
        [
            "id" => 1,
            "name" => "Black Demin Jeans",
            "price" => 49.99,
            "description" => "Premium Black Denim Jeans",
            "image_url" => "assets/images/jeans.png",
            "on_sale" => false,
            "quantity_available" => 5,
        ],
        [
            "id" => 2,
            "name" => "Red Sweater",
            "price" => 59.99,
            "description" => "Red Sweater With Classic Branding",
            "image_url" => "assets/images/red-sweater.png",
            "on_sale" => false,
            "quantity_available" => 18,
        ],
        [
            "id" => 3,
            "name" => "Orange Fitted Hat",
            "price" => 13.99,
            "description" => "Orange Fitted Trucker Hat",
            "image_url" => "assets/images/orange-hat.png",
            "on_sale" => true,
            "regular_price" => 19.99,
            "sale_price" => 13.99,
            "quantity_available" => 35,
        ],
        [
            "id" => 4,
            "name" => "Black Leather Belt",
            "price" => 89.99,
            "description" => "Premium Black Leather Belt",
            "image_url" => "assets/images/belt.png",
            "on_sale" => false,
            "quantity_available" => 0,
        ],
        [
            "id" => 5,
            "name" => "Camo Hat",
            "price" => 12.99,
            "description" => "Camo Snapback Hat",
            "image_url" => "assets/images/camo-hat.png",
            "on_sale" => true,
            "regular_price" => 19.99,
            "sale_price" => 12.99,
            "quantity_available" => 104,
        ],
        [
            "id" => 6,
            "name" => "Silver Rings",
            "price" => 100.00,
            "description" => "925 Silver Ring With Engravings",
            "image_url" => "assets/images/ring.png",
            "on_sale" => true,
            "regular_price" => 150.00,
            "sale_price" => 100.00,
            "quantity_available" => 21,
        ],
        [
            "id" => 7,
            "name" => "Puffer Jacket",
            "price" => 432.00,
            "description" => "Modern Styled Black Puffer Jacket (Weather Resistant)",
            "image_url" => "assets/images/jacket.png",
            "on_sale" => false,
            "quantity_available" => 3,
        ],
        [
            "id" => 8,
            "name" => "Pink Sweater",
            "price" => 21.00,
            "description" => "Pink Cotton Sweater With Logo",
            "image_url" => "assets/images/pink-sweater.png",
            "on_sale" => false,
            "quantity_available" => 0,
        ],
        [
            "id" => 9,
            "name" => "Multi-Colored Sneakers",
            "price" => 145.00,
            "description" => "Multi-Colored Low Top Sneakers",
            "image_url" => "assets/images/sneaker.png",
            "on_sale" => false,
            "quantity_available" => 15,
        ],
    ];

    // Loop Thru Products to get the quantity available
    for ($i = 0; $i < count($products); $i++) {
        if ($products[$i]['quantity_available'] == 0) {
            $products[$i]['quantity_available'] = "Out of Stock";
        }
    }

    // You can create an array to store all products for later use if needed
    $allProductDetails = [];

    // Loop Thru Products to display them on webshop
    foreach ($products as $product) {
        $productId = $product['id'];
        $productName = $product['name'];
        $productPrice = $product['price'];
        $productDescription = $product['description'];
        $productImage = $product['image_url'];
        $productOnSale = $product['on_sale'];
        $productQuantity = $product['quantity_available'];
        $productRegularPrice = isset($product['regular_price']) ? $product['regular_price'] : null;
        $productSalePrice = isset($product['sale_price']) ? $product['sale_price'] : null;
        $saleDisplayValue = ($productOnSale ? $productSalePrice : 'False');
        
        // Store product details in an array
        $allProductDetails[$productId] = [
            'id' => $productId,
            'name' => $productName,
            'price' => $productPrice,
            'description' => $productDescription,
            'image_url' => $productImage,
            'on_sale' => $productOnSale,
            'quantity_available' => $productQuantity,
            'regular_price' => $productRegularPrice,
            'sale_price' => $productSalePrice,
            'sale_display_value' => $saleDisplayValue,
        ];
    }
    
    // On Sale Filtering
    $onSaleProducts = array();

    // Add the on-sale product to the new array
    foreach ($products as $product) {
        if ($product['on_sale'] == true) {
            $onSaleProducts[] = $product; 
        }
    }


    // Create an empty array for the cart
    $cart = [];

    // Loop through the products array for sale prices
    for ($i = 0; $i < count($products); $i++) {
        // Check if the product is on sale
        if ($products[$i]['on_sale']) {
            // If it is on sale, add the sale price to the cart
            $cart[] = $products[$i]['sale_price'];
        } else {
            // If it is not on sale, add the regular price to the cart
            $cart[] = $products[$i]['price'];
        }
    }

?>