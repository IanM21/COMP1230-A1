// Get references to the form and div elements
var formContainer = document.querySelector(".form-container");
var userInfoDiv = document.querySelector(".user-info");
var storeResultsDiv = document.querySelector(".store");

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

    // Hide the form
    formContainer.style.display = "none";
    storeResultsDiv.style.display = "flex";

} else {
    // Add an event listener for the form submission
    formContainer.addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent the form from actually submitting

        var fullName = document.getElementById("name").value;
        var studentID = document.getElementById("studentID").value;

        // Check if name is not empty and is a string with more than 3 letters
        if (fullName === "" || fullName.length <= 3) {
            alert("Name must not be empty and should have more than 3 letters");
            return;
        }
        
        // Check if studentID is not empty and is an integer
        if (studentID === "" || isNaN(studentID) || !Number.isInteger(Number(studentID))) {
            alert("Student ID must not be empty and should be a valid integer");
            return;
        }

        // Display user info
        var nameTag = document.getElementById("nameOutput");
        var studentIDTag = document.getElementById("studentIDOutput");

        nameTag.textContent = fullName;
        studentIDTag.textContent = studentID;

        // If login is successful, show the .store element
        storeResultsDiv.style.display = "flex";
        userInfoDiv.style.display = "flex";

        // Hide the form
        formContainer.style.display = "none";

        // Store the user info in cookies
        document.cookie = "name=" + fullName;
        document.cookie = "studentID=" + studentID;

        // Log the cookies for debugging
        console.log(document.cookie);

        // Now, submit the form to the server for PHP processing
        this.submit();
    });
}

// Function to get a cookie by name
function getCookie(name) {
    var cookies = document.cookie.split(';');
    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i].trim();
        if (cookie.indexOf(name + '=') === 0) {
            return cookie.substring(name.length + 1);
        }
    }
    return null;
}

// Function to display user information on the webpage
function displayUserInfo(userInfo) {
    var nameTag = document.getElementById("nameOutput");
    var studentIDTag = document.getElementById("studentIDOutput");

    nameTag.textContent = userInfo.name;
    studentIDTag.textContent = userInfo.studentID;

    userInfoDiv.style.display = "flex";
    storeResultsDiv.style.display = "flex";
}

// Update cart count span every time an item is added to the cart
var cartCount = document.getElementById("badge");
var cartCountValue = 0;
cartCount.textContent = cartCountValue;

// Get the error message element
var errorMessage = document.getElementById("error-message");
errorMessage.style.color = "red"; // Set error message color to red

function updateCartCount() {
    cartCountValue++;
    cartCount.textContent = cartCountValue;
}

// Add an event listener for the checkbox change
var checkboxes = document.querySelectorAll("input[type='checkbox']");
checkboxes.forEach(function (checkbox) {
    checkbox.addEventListener("change", function () {
        if (this.checked) {
            updateCartCount();
        }
    });
});

// Add an event listener for quantity input change
var quantityInputs = document.querySelectorAll("input[type='number']");
quantityInputs.forEach(function (input) {
    input.addEventListener("change", function () {
        var quantity = parseInt(this.value);
        if (isNaN(quantity) || quantity <= 0) {
            // Display an error message if quantity is invalid
            errorMessage.textContent = "Quantity must be a positive number.";
            errorMessage.style.display = "block";
            this.value = 1; // Reset the quantity input to 1
        } else {
            errorMessage.textContent = ""; // Clear the error message
            errorMessage.style.display = "none"; // Hide the error message
        }
    });
});

// Get all product elements (assuming they are wrapped in a container with class "product")
var products = document.querySelectorAll(".product");

// Loop through each product
products.forEach(function(product) {
    // Find the sale-item and regular-price elements within this product
    var saleItem = product.querySelector("#sale-item");
    var regularPrice = product.querySelector("#regular-price");
    var regPriceValue = regularPrice.textContent;

    // remove any regular price text that is "Regular Price:"
    if (regPriceValue.trim() == "Regular Price:") {
        regularPrice.textContent = "";
    }
    else {
        return false;
    }
});

// Footer 
const currentYear = new Date().getFullYear();
const footer = document.querySelector("footer");

// Create social media icons
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