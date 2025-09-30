<?php
// Turn on error reporting while debugging
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

// Include header template
include 'header.php';

// Include dependencies
require_once 'database.php';
require_once 'order.php';

// this Handles form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connect to database
    $db = new Database();
    $conn = $db->getConnection();

    // now we Create an order object
    $order = new Order($conn);

    // Save the order to database
    $ok = $order->storeOrder(
        $_POST['customer_name']   ?? '',
        $_POST['email_address']   ?? '',
        $_POST['street_address']  ?? '',
        $_POST['contact_phone']   ?? '',
        $_POST['num_pizzas']      ?? 1,
        $_POST['size_choice']     ?? '',
        $_POST['crust_choice']    ?? '',
        $_POST['chosen_toppings'] ?? '',
        $_POST['payment_option']  ?? 'Cash',
        $_POST['extra_notes']     ?? ''
    );

    // Show success/fail message
    if ($ok) {
        echo '<p style="color:green;font-weight:bold;">Order received. Thank you!</p>';
    } else {
        echo '<p style="color:red;font-weight:bold;">Oops… problem saving order.</p>';
    }
}
?>


<form method="POST" action="orderpizza.php">

  <label>Name:</label>
  <input type="text" name="customer_name" required><br>

  <label>Email:</label>
  <input type="email" name="email_address" required><br>

  <label>Address:</label>
  <input type="text" name="street_address" required><br>

  <label>Phone:</label>
  <input type="tel" name="contact_phone"><br>

  <label>How many pizzas:</label>
  <input type="number" name="num_pizzas" value="1" min="1"><br>

  <label>Size:</label>
  <select name="size_choice" required>
    <option value="Small">Small</option>
    <option value="Medium">Medium</option>
    <option value="Large">Large</option>
    <option value="XL">Extra Large</option>
  </select><br>

  <label>Crust:</label>
  <select name="crust_choice">
    <option value="Thin">Thin</option>
    <option value="Classic">Classic</option>
    <option value="Pan">Pan</option>
    <option value="Stuffed">Stuffed</option>
  </select><br>

  <label>Toppings:</label>
  <textarea name="chosen_toppings"></textarea><br>

  <label>Payment:</label>
  <select name="payment_option">
    <option value="Cash">Cash</option>
    <option value="Card">Card</option>
    <option value="Online">Online</option>
  </select><br>

  <label>Notes:</label>
  <textarea name="extra_notes"></textarea><br>

  <button type="submit">Place Pizza Order</button>
</form>

<?php include 'footer.php'; ?>



