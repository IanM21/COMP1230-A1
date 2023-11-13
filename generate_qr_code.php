<?php
require 'phpqrcode/qrlib.php'; // Include the QR code library

// Get the product ID from the query string
$productId = $_GET['id'];

// URL to encode in the QR code (you can customize this as needed)
$productURL = "https://f3419262.gblearn.com/comp1230/assignments/assignment1/product.php?id={$productId}";

// Set the content type to image/png
header('Content-Type: image/png');

// Generate and output the QR code directly to the browser
QRcode::png($productURL);
?>