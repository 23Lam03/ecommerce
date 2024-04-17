<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <style>
       body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
    background-image: url('background.jpg'); /* Hình ảnh nền */
    background-size: cover;
    background-position: center;
}

.container {
    max-width: 600px;
    margin: 20px auto;
    background-color: rgba(255, 255, 255, 0.9); /* Màu nền với độ trong suốt */
    border-radius: 8px;
    padding: 40px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    text-align: center;
}

h2 {
    color: #ff6f61; /* Màu đỏ sinh động cho tiêu đề */
    margin-bottom: 20px;
    font-size: 30px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3); /* Hiệu ứng bóng cho tiêu đề */
}

p {
    color: #333; /* Màu chữ đậm cho các đoạn văn bản */
    margin-bottom: 15px;
    font-size: 18px;
    line-height: 1.6;
}

.thank-you {
    margin-bottom: 30px;
    font-size: 24px;
    color: #00b894; /* Màu xanh lá cây sinh động */
}

a {
    color: #fff;
    background-color: #6c5ce7; /* Màu tím sinh động cho nút */
    text-decoration: none;
    font-size: 18px;
    padding: 10px 30px;
    border-radius: 5px;
    transition: background-color 0.3s ease, color 0.3s ease;
    display: inline-block;
    margin-top: 20px;
}

a:hover {
    background-color: #4834d4; /* Màu tím đậm khi rê chuột vào nút */
}

    </style>
</head>
<body>
<div class="container">
    <?php
    // Include database connection
    require_once("connectDB.php");

    // Function to sanitize input data
    function sanitize_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Check if the request method is POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get and sanitize information from the form
        $name = sanitize_input($_POST["name"]);
        $address = sanitize_input($_POST["address"]);
        $phone_number = sanitize_input($_POST["phone"]);

        // Start session
        session_start();

        // Check if the cart is empty
        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            echo '<script language="javascript">
                    alert("The shopping cart is empty, please select a product");
                    window.location="products.php"
                    </script>';
        }

        // Initialize variables for total quantity and total price
        $total_quantity = 0;
        $total_price = 0;

        // Get current date and time
        $current_datetime = date("Y-m-d H:i:s");

        // Insert customer information into 'payments' table
        $sql_payment = "INSERT INTO payments (name, address, phone, payment_datetime) VALUES (?, ?, ?, ?)";
        $stmt_payment = $conn->prepare($sql_payment);
        $stmt_payment->bind_param("ssss", $name, $address, $phone_number, $current_datetime);
        if ($stmt_payment->execute()) {
            // Retrieve the ID of the last inserted payment record
            $payment_id = $stmt_payment->insert_id;

            // Insert purchased products information into 'purchased_products' table
            foreach ($_SESSION['cart'] as $product_id => $quantity) {
                // Retrieve product information from the database
                $sql_product = "SELECT * FROM product WHERE ProID = ?";
                $stmt_product = $conn->prepare($sql_product);
                $stmt_product->bind_param("i", $product_id);
                if ($stmt_product->execute()) {
                    $result_product = $stmt_product->get_result();
                    if ($result_product->num_rows > 0) {
                        $row_product = $result_product->fetch_assoc();
                        $product_name = $row_product['ProName'];
                        $manufacturer = isset($row_product['Manufacturer']) ? $row_product['Manufacturer'] : "Unknown";
                        $price_per_unit = $row_product['Price'];

                        // Calculate total quantity and total price
                        $total_quantity += $quantity;
                        $total_price += $price_per_unit * $quantity;

                        // Insert purchased product details into 'purchased_products' table
                        $sql_insert_product = "INSERT INTO purchased_products (payment_id, product_id, product_name, manufacturer, price_per_unit, quantity, purchase_datetime) VALUES (?, ?, ?, ?, ?, ?, ?)";
                        $stmt_insert_product = $conn->prepare($sql_insert_product);
                        $stmt_insert_product->bind_param("iisssid", $payment_id, $product_id, $product_name, $manufacturer, $price_per_unit, $quantity, $current_datetime);
                        if (!$stmt_insert_product->execute()) {
                            echo "Error inserting purchased product: " . $conn->error;
                        }
                    } else {
                        echo "Error retrieving product information: " . $conn->error;
                    }
                } else {
                    echo "Error retrieving product information: " . $conn->error;
                }
            }

            // Payment successful message
            echo "<h2>Payment Successful</h2>";
            echo "<p class='thank-you'>Thank you for your purchase, $name!</p>";
            echo "<p><strong>Customer Information:</strong></p>";
            echo "<p><strong>Name:</strong> $name</p>";
            echo "<p><strong>Phone:</strong> $phone_number</p>";
            echo "<p><strong>Address:</strong> $address</p>";
            echo "<p><strong>Payment Date and Time:</strong> $current_datetime</p>";
            echo "<p><strong>Product Information:</strong></p>";
            echo "<ul>";
            foreach ($_SESSION['cart'] as $product_id => $quantity) {
                $sql_product_info = "SELECT * FROM product WHERE ProID = $product_id";
                $result_product_info = $conn->query($sql_product_info);
                if ($result_product_info && $result_product_info->num_rows > 0) {
                    $row_product_info = $result_product_info->fetch_assoc();
                    $product_name = $row_product_info['ProName'];
                    echo "<li>$product_name (Quantity: $quantity)</li>";
                } else {
                    echo "Error retrieving product information: " . $conn->error;
                }
            }
            echo "</ul>";
            echo "<p><strong>Total Quantity:</strong> $total_quantity</p>";
            echo "<p><strong>Total Price:</strong> $total_price</p>";

            // Clear the cart
            unset($_SESSION['cart']);

        } else {
            echo "Error inserting payment information: " . $conn->error;
        }

        // Close prepared statements
        $stmt_payment->close();
        $stmt_product->close();
        $stmt_insert_product->close();

        // Close the database connection
        $conn->close();
    } else {
        // Redirect users if the request method is not POST
        header("Location: payment_page.php");
        exit();
    }
    ?>
    <a href="index.php">Back to Homepage</a>
</div>
</body>
</html>