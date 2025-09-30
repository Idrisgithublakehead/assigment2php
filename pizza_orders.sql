-- Table for storing pizza orders
DROP TABLE IF EXISTS orders_table;

-- below is all information the user needs to order the pizza
CREATE TABLE orders_table (
  order_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(120) NOT NULL,
  customer_email VARCHAR(120) NOT NULL,
  delivery_address VARCHAR(255) NOT NULL,
  phone_number VARCHAR(25) DEFAULT NULL,
  order_quantity TINYINT UNSIGNED NOT NULL DEFAULT 1,
  pizza_size ENUM('Small','Medium','Large','XL') NOT NULL,
  base_crust ENUM('Thin','Classic','Pan','Stuffed') DEFAULT 'Classic',
  extra_toppings TEXT,
  payment_type ENUM('Card','Cash','Online') DEFAULT 'Cash',
  order_notes VARCHAR(400) DEFAULT NULL,
  status ENUM('New','In Progress','Completed','Cancelled') DEFAULT 'New',
  submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX (customer_email),
  INDEX (submitted_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

