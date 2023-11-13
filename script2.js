// Get user info element
var userInfoDiv = document.querySelector(".user-info");

// Check if the 'name' and 'studentID' cookies exist
var nameCookie = getCookie('name');
var studentIDCookie = getCookie('studentID');
if (nameCookie && studentIDCookie) {
    // If both cookies exist, user information is already collected
    var userInfo = {
        name: nameCookie,
        studentID: studentIDCookie
    };

    // Display the user information
    displayUserInfo(userInfo);
}

// Function to display user information on the webpage
function displayUserInfo(userInfo) {
    var nameTag = document.getElementById("nameOutput");
    var studentIDTag = document.getElementById("studentIDOutput");

    nameTag.textContent = userInfo.name;
    studentIDTag.textContent = userInfo.studentID;

    userInfoDiv.style.display = "flex";
}

// Function to get the value of a cookie
function getCookie(name) {
  var cookies = document.cookie.split(';');
  for (var i = 0; i < cookies.length; i++) {
      var cookie = cookies[i].trim();
      if (cookie.indexOf(name + '=') === 0) {
          return decodeURIComponent(cookie.substring(name.length + 1));
      }
  }
  return null;
}

// Set Cookie Function
function setCookie(name, value, daysToExpire) {
  var expirationDate = new Date();
  expirationDate.setDate(expirationDate.getDate() + daysToExpire);
  var cookieValue = encodeURIComponent(value) + "; expires=" + expirationDate.toUTCString();
  document.cookie = name + "=" + cookieValue + "; path=/";
}

var currentPath = window.location.pathname;

if (currentPath.includes('/cart.php')) {
    console.log('Cart page');

    // Function to get the cart count from the cookie
    function getCartCountFromCookie() {
        var cartCountCookie = getCookie("cartCount");
        return cartCountCookie ? parseInt(cartCountCookie) : 0;
    }

    // Get the cart count from the cookie
    var cartCountValue = getCartCountFromCookie();

    // Display the cart count
    var cartCount = document.getElementById("badge");
    cartCount.textContent = cartCountValue;
}

// Function to update cart count based on cart items
function updateCartCountFromCartArray() {
    // Get the cart array from the cookie
    var cartCookie = getCookie("cart");
    var cart = cartCookie ? JSON.parse(cartCookie) : [];

    var cartCount = document.getElementById("badge");
    var cartCountValue = cart.length;
    cartCount.textContent = cartCountValue;
    console.log("Cart count: " + cartCountValue);
}

// Call the function to update cart count
updateCartCountFromCartArray();

if (currentPath.includes('/product.php')) {
    console.log('Product page');

    var cart = [];

    // load the cart from a cookie
    function loadCartFromCookie() {
        var cartCookie = getCookie("cart");
        if (cartCookie) {
            cart = JSON.parse(cartCookie);
        }
    }

    // save the cart to a cookie
    function saveCartToCookie() {
        setCookie("cart", JSON.stringify(cart), 1); // Store the cart for 1 day
    }

    loadCartFromCookie();

    // Update cart count every time an item is added
    var cartCount = document.getElementById("badge");
    var cartCountValue = cart.length;
    cartCount.textContent = cartCountValue;

    function updateCartCount() {
        cartCountValue = cart.length;
        cartCount.textContent = cartCountValue;
    }
    // Add an event listener for the ATC button
    var addToCartButton = document.getElementById("atc-btn");
    addToCartButton.addEventListener("click", function () {
        console.log("Button clicked!");
        var quantityInput = document.getElementById("quantity");
        var errorMessage = document.getElementById("error-message");
        var stockLimitElement = document.getElementById("stock");

        var pidElement = document.getElementById("pid");
        var pid = parseInt(pidElement.textContent); // Get the product ID

        var quantity = parseInt(quantityInput.value);
        var stockLimit = parseInt(stockLimitElement.textContent);

        if (isNaN(quantity) || quantity <= 0 || quantity > stockLimit) {
            // Display an error message if quantity is invalid
            errorMessage.textContent = "Quantity must be a positive number and should not exceed the stock limit.";
            errorMessage.style.color = "red";
            errorMessage.style.display = "block";
        } else {
            errorMessage.textContent = "";
            errorMessage.style.display = "none";
            console.log("Quantity: " + quantity);

            var cartItem = {
                productId: pid,
                quantity: quantity
            };

            // Add the cartItem to the cart array
            cart.push(cartItem);

            updateCartCount();

            // After adding the item to the cart array, save it to the cookie
            saveCartToCookie();
        }
    });
}

if (currentPath.includes('/cart.php')) {
    // Parse the cart cookie
    function parseCartCookie() {
        var cartCookie = getCookie("cart");
        return cartCookie ? JSON.parse(cartCookie) : [];
    }
}

// Footer 
const currentYear = new Date().getFullYear();
const footer = document.querySelector("footer");

// Create Name
const myname = "Ian McDonald";

// Set phone number
const myschool = "George Brown College";

// Update footer content
footer.innerHTML = `
  <div class="footer-content">
    ${myname}
    <p id=copyright>&copy; ${currentYear}</p>
    <p id=school>${myschool}</p>
  </div>
`;

function adjustBodyMargin() {
  const footerHeight = footer.offsetHeight;
  document.body.style.marginBottom = `${footerHeight}px`;
}

function handleResize() {
  adjustBodyMargin();
}

window.addEventListener('resize', handleResize);

adjustBodyMargin();