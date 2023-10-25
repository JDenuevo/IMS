<?php
include '../../../conn.php';
date_default_timezone_set('Asia/Manila');

function generateSerialNumber() {
    // Set the time zone to Asia/Manila
    date_default_timezone_set('Asia/Manila');
    
    // Get the current date components
    $year = date("Y");
    $month = date("m");
    $day = date("d");
    
    // Generate a random 4-digit number
    $randomNumber = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
    
    // Create the serial number
    $serialNumber = "$year$month$day$randomNumber";
    
    return $serialNumber;
}

if (isset($_POST["save_brand"])) {
    // Get the brand name from the form
    $brand_name = $_POST['brand_name'];

    // Create a prepared statement for inserting a brand
    $sql = "INSERT INTO ims_brands (brand_name) VALUES (?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Bind parameters and execute the query
        mysqli_stmt_bind_param($stmt, "s", $brand_name);

        if (mysqli_stmt_execute($stmt)) {
            // Query executed successfully
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header('Location: ../brand.php');
        } else {
            // Handle errors here
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        // Handle errors in preparing the statement
        echo "Error: " . mysqli_error($conn);
    }
} 
elseif (isset($_POST["save_category"])) {
    $category_name = $_POST['category_name'];

    // Create a prepared statement for inserting a category
    $sql = "INSERT INTO ims_categories (category_name) VALUES (?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Bind parameters and execute the query
        mysqli_stmt_bind_param($stmt, "s", $category_name);

        if (mysqli_stmt_execute($stmt)) {
            // Query executed successfully
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header('Location: ../category.php');
        } else {
            // Handle errors here
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        // Handle errors in preparing the statement
        echo "Error: " . mysqli_error($conn);
    }
}
elseif (isset($_POST["save_warehouse"])) {
    $warehouse_name = $_POST['warehouse_name'];
    $warehouse_add = $_POST['warehouse_add'];

    // Create a prepared statement for inserting a warehouse
    $sql = "INSERT INTO ims_warehouses (warehouse_name, warehouse_add) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Bind parameters and execute the query
        mysqli_stmt_bind_param($stmt, "ss", $warehouse_name, $warehouse_add);

        if (mysqli_stmt_execute($stmt)) {
            // Query executed successfully
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header('Location: ../warehouse.php');
        } else {
            // Handle errors here
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        // Handle errors in preparing the statement
        echo "Error: " . mysqli_error($conn);
    }
}
elseif (isset($_POST["save_supplier"])) {
    $supplier_name = $_POST['supplier_name'];
    $supplier_add = $_POST['supplier_add'];
    $supplier_email = $_POST['supplier_email'];

    // Create a prepared statement for inserting a supplier
    $sql = "INSERT INTO ims_suppliers (supplier_name, supplier_add, supplier_email) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Bind parameters and execute the query
        mysqli_stmt_bind_param($stmt, "sss", $supplier_name, $supplier_add, $supplier_email);

        if (mysqli_stmt_execute($stmt)) {
            // Query executed successfully
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header('Location: ../supplier.php');
            exit(); // Terminate the script to prevent further execution
        } else {
            // Handle errors here
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        // Handle errors in preparing the statement
        echo "Error: " . mysqli_error($conn);
    }
}
elseif (isset($_POST["save_product"])) {
    // Include your database connection code here

    // Sanitize user inputs to prevent SQL injection
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $product_description = mysqli_real_escape_string($conn, $_POST['product_description']);
    $category = isset($_POST['category']) ? mysqli_real_escape_string($conn, $_POST['category']) : null;
    $brand = isset($_POST['brand']) ? mysqli_real_escape_string($conn, $_POST['brand']) : null;
    $supplier = isset($_POST['supplier']) ? mysqli_real_escape_string($conn, $_POST['supplier']) : null;
    $warehouse = mysqli_real_escape_string($conn, $_POST['warehouse']);
    $status = "Usable";
    $date_created = date('Y-m-d H:i:s');

    // Generate a serial number
    $product_id = generateSerialNumber(); // Ensure this function is defined

    // Create prepared statements for product and log
    $productSql = "INSERT INTO ims_products (product_id, product_name, product_description, category, brand, supplier, warehouse, status, last_updated) 
            VALUES (?, ?,?, ?, ?, ?, ?, ?, ?)";
    
    $logSql = "INSERT INTO ims_logs (subject, description, date_created) VALUES (?, ?, NOW())";

    $productStmt = mysqli_prepare($conn, $productSql);
    $logStmt = mysqli_prepare($conn, $logSql);

    if ($productStmt && $logStmt) {
        // Bind parameters and execute the product query
        mysqli_stmt_bind_param($productStmt, "sssssssss", $product_id, $product_name, $product_description, $category, $brand, $supplier, $warehouse, $status, $date_created);
        if (mysqli_stmt_execute($productStmt)) {
            // Product inserted successfully

            // Bind parameters and execute the log query
            $logSubject = "Added a Product";
            $logDescription = "Product Name: " . $product_name . "<br>" ."Product ID: ". $product_id;
            mysqli_stmt_bind_param($logStmt, "ss", $logSubject, $logDescription);
            if (mysqli_stmt_execute($logStmt)) {
                // Log entry inserted successfully

                // Close the statements and the database connection
                mysqli_stmt_close($productStmt);
                mysqli_stmt_close($logStmt);
                mysqli_close($conn);

                // Redirect the user to the previous page
                header('Location: ../product.php');
                exit(); // Terminate the script to prevent further execution
            } else {
                // Handle errors in log entry
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            // Handle errors in product insertion
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        // Handle errors in preparing the statements
        echo "Error: " . mysqli_error($conn);
    }
}


?>