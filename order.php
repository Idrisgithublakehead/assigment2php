<?php
// This class is responsible for saving pizza orders to the database
class Order {
    private $conn;                  // database connection
    private $table = 'orders_table'; // name of the table we created in MySQL

    // Constructor: called when we create a new Order object
    public function __construct($dbConn) {
        $this->conn = $dbConn;
    }

    // this below is Method that inserts a new order into the database
    public function storeOrder(
        $customer_name,
        $email_address,
        $street_address,
        $contact_phone,
        $num_pizzas,
        $size_choice,
        $crust_choice,
        $chosen_toppings,
        $payment_option,
        $extra_notes
    ) {
        // now we used an  SQL statement with placeholders for values
        $sql = "INSERT INTO {$this->table}
            (full_name, customer_email, delivery_address, phone_number,
             order_quantity, pizza_size, base_crust, extra_toppings,
             payment_type, order_notes)
            VALUES
            (:full_name, :customer_email, :delivery_address, :phone_number,
             :order_quantity, :pizza_size, :base_crust, :extra_toppings,
             :payment_type, :order_notes)";

        // Prepare the SQL statement (helps prevent SQL injection)
        $stmt = $this->conn->prepare($sql);

        // Bind PHP variables to the SQL placeholders
        $stmt->bindParam(':full_name',        $customer_name);
        $stmt->bindParam(':customer_email',   $email_address);
        $stmt->bindParam(':delivery_address', $street_address);
        $stmt->bindParam(':phone_number',     $contact_phone);
        $stmt->bindParam(':order_quantity',   $num_pizzas, PDO::PARAM_INT);
        $stmt->bindParam(':pizza_size',       $size_choice);
        $stmt->bindParam(':base_crust',       $crust_choice);
        $stmt->bindParam(':extra_toppings',   $chosen_toppings);
        $stmt->bindParam(':payment_type',     $payment_option);
        $stmt->bindParam(':order_notes',      $extra_notes);

        // Execute the SQL and return true if successful, false otherwise
        return $stmt->execute();
    }
}
