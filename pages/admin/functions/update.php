<?php
include '../../../conn.php';
date_default_timezone_set('Asia/Manila');

if (isset($_POST["update_brand"])) {
    // Get the new brand name and brand_id from the form
    $brand_id = $_POST['brand_id'];
    $brand_name = $_POST['brand_name'];

    // Update the brand in the database
    $sql = "UPDATE ims_brands SET brand_name = ? WHERE brand_id = ?";
    $stmt = $conn->prepare($sql);

    // Use bind_param to bind parameters
    $stmt->bind_param("si", $brand_name, $brand_id);

    if ($stmt->execute()) {
        // Successful update
        $stmt->close();
        mysqli_close($conn);
        header('Location: ../brand.php');
    }
}

elseif (isset($_POST["update_category"])) {
    // Get the new category name and category_id from the form
    $category_id = $_POST['category_id'];
    $category_name = $_POST['category_name'];

    // Update the category in the database
    $sql = "UPDATE ims_categories SET category_name = ? WHERE category_id = ?";
    $stmt = $conn->prepare($sql);

    // Use bind_param to bind parameters
    $stmt->bind_param("si", $category_name, $category_id);

    if ($stmt->execute()) {
        // Successful update
        $stmt->close();
        mysqli_close($conn);
        header('Location: ../category.php');
    }
}
elseif (isset($_POST["update_warehouse"])) {
    // Get the new warehouse name, warehouse_add, and warehouse_id from the form
    $warehouse_id = $_POST['warehouse_id'];
    $warehouse_name = $_POST['warehouse_name'];
    $warehouse_add = $_POST['warehouse_add'];

    // Update the warehouse in the database
    $sql = "UPDATE ims_warehouses SET warehouse_name = ?, warehouse_add = ? WHERE warehouse_id = ?";
    $stmt = $conn->prepare($sql);

    // Use bind_param to bind parameters with the correct data types
    $stmt->bind_param("ssi", $warehouse_name, $warehouse_add, $warehouse_id);

    if ($stmt->execute()) {
        // Successful update
        $stmt->close();
        mysqli_close($conn);
        header('Location: ../warehouse.php');
    }
}
elseif (isset($_POST["update_supplier"])) {
    // Get the new supplier name, supplier_add, and supplier_id from the form
    $supplier_id = $_POST['supplier_id'];
    $supplier_name = $_POST['supplier_name'];
    $supplier_add = $_POST['supplier_add'];
    $supplier_email = $_POST['supplier_email'];

    // Update the supplier in the database
    $sql = "UPDATE ims_suppliers SET supplier_name = ?, supplier_add = ?, supplier_email = ? WHERE supplier_id = ?";
    $stmt = $conn->prepare($sql);

    // Use bind_param to bind parameters with the correct data types
    $stmt->bind_param("sssi", $supplier_name, $supplier_add, $supplier_email, $supplier_id);

    if ($stmt->execute()) {
        // Successful update
        $stmt->close();
        mysqli_close($conn);
        header('Location: ../supplier.php');
    }
}

elseif (isset($_POST["update_product"])) {
    // Get the product details from the form
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $category = isset($_POST['category']) ? $_POST['category'] : null;
    $brand = isset($_POST['brand']) ? $_POST['brand'] : null;
    $supplier = isset($_POST['supplier']) ? $_POST['supplier'] : null;
    $warehouse = $_POST['warehouse'];

    $old_product_name = isset($_POST['old_product_name']) ? $_POST['old_product_name'] : null;
    $subject = "Updated a Product";

    // Check if the product name has changed
    if ($old_product_name !== $product_name) {
        $description = "Changed the product named " . $old_product_name . " to " . $product_name;

        $date_created = date('Y-m-d H:i:s');

        // Create a prepared statement for inserting a log
        $sql1 = "INSERT INTO ims_logs (subject, description, date_created) VALUES (?, ?, ?)";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param("sss", $subject, $description, $date_created);

        // Execute the log insertion query
        $stmt1->execute();
        $stmt1->close();
    }

    // Update the product in the database
    $sql = "UPDATE ims_products SET 
            product_name = ?,
            category = ?,
            brand = ?,
            supplier = ?,
            warehouse = ?
            WHERE product_id = ?";

    $stmt = $conn->prepare($sql);

    // Use bind_param to bind parameters with the correct data types
    $stmt->bind_param("ssssss", $product_name, $category, $brand, $supplier, $warehouse, $product_id);

    if ($stmt->execute()) {
        // Successful update
        $stmt->close();
        mysqli_close($conn);
        header('Location: ../product.php');
    }
}

elseif (isset($_POST["update_stocks"])) {
    // Get the product details from the form
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $stock = $_POST['stock'];
    $status = $_POST['status'];

    $old_stock = $_POST['old_stock'];
    $old_status = $_POST['old_status'];

    $changesDetected = false; // Flag to track changes

    $description = "Product ID: " . $product_id . "<br>" . "Product Name: " . $product_name . "<br>"; // Start with a newline

    // Check for changes in stocks
    if ($old_stock !== $stock) {
        $description .= "Stock: from $old_stock to $stock" . "<br>"; // Newline after stock change
        $changesDetected = true;
    }

    // Check for changes in status
    if ($old_status !== $status) {
        $description .= "Status: from $old_status to $status" . "<br>"; // Newline after status change
        $changesDetected = true;
    }

    // Create a log entry only if changes are detected
    if ($changesDetected) {
        $subject = "Updated a Product";
        $date_created = date('Y-m-d H:i:s');

        // Create a prepared statement for inserting a log
        $sql1 = "INSERT INTO ims_logs (subject, description, date_created) VALUES (?, ?, ?)";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param("sss", $subject, $description, $date_created);

        // Execute the log insertion query
        $stmt1->execute();
        $stmt1->close();
    }

    $uploadDirectory = 'uploads/';
    if (!file_exists($uploadDirectory)) {
        mkdir($uploadDirectory, 0755, true);
    }

    // Check if a new image was uploaded
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == UPLOAD_ERR_OK) {
        $temp_name = $_FILES['profile_image']['tmp_name'];
        $image_name = $_FILES['profile_image']['name'];
        $new_image_path = $uploadDirectory . $image_name;

        // Move the uploaded image to the "uploads" folder
        move_uploaded_file($temp_name, $new_image_path);
    } else {
        // No new image was uploaded, so keep the current image path
        $new_image_path = $src;
    }

    // Update the product in the database
    $sql = "UPDATE ims_products SET 
    product_name = ?,
    stocks = ?,
    product_image = ?,
    status = ?,
    last_updated = CONVERT_TZ(NOW(), '+00:00', '-06:00')
    WHERE product_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $product_name, $stock, $new_image_path, $status, $product_id);

    if ($stmt->execute()) {
        // Successful update
        $stmt->close();
        mysqli_close($conn);
        header('Location: ../stocks.php');
    }
}
elseif (isset($_POST["update_account"])) {
    // Get the product details from the form
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $privilege = "Administrator";

    $old_profile_picture = $_POST['old_profile_image'];
    $old_username = trim($_POST['old_username']);
    $old_password = trim($_POST['old_password']);

    // Generate secure password hashes
    $password_hashed = $old_password_hashed = null;

    if (!empty($password)) {
        $password_hashed = md5($password);
    }

    $uploadDirectory = 'uploads/';

    if (!file_exists($uploadDirectory)) {
        mkdir($uploadDirectory, 0755, true);
    }

    // Check if a new image was uploaded
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == UPLOAD_ERR_OK) {
        $temp_name = $_FILES['profile_image']['tmp_name'];
        $image_name = $_FILES['profile_image']['name'];
        $new_image_path = $uploadDirectory . $image_name;

        // Move the uploaded image to the "uploads" folder
        move_uploaded_file($temp_name, $new_image_path);
    } else {
        // No new image was uploaded, so keep the current image path
        $new_image_path = $old_profile_picture;
    }

    // Create an array of the changed fields
    $changed_fields = [];
    if ($username != $old_username) {
        $changed_fields['username'] = $username;
    }
    if (!empty($password) && $password_hashed != $old_password_hashed) {
        $changed_fields['password'] = $password_hashed;
    }
    if ($new_image_path != $old_profile_picture) {
        $changed_fields['profile'] = $new_image_path;
    }

    // If there are any changed fields, update the product in the database
    if (!empty($changed_fields)) {
        $sql = "UPDATE ims_login SET ";
        $types = '';

        foreach ($changed_fields as $field => $value) {
            $sql .= "$field = ?, ";
            $types .= 's'; // Add a corresponding type for each field
        }

        $sql = rtrim($sql, ', ');
        $sql .= " WHERE privilege = ?";
        $types .= 's'; // Add the type for the privilege

        $stmt = $conn->prepare($sql);

        // Create an array of values for binding
        $values = array_values($changed_fields);
        $values[] = $privilege; // Add the privilege at the end

        // Combine the types and values arrays and pass them to bind_param
        $stmt->bind_param($types, ...$values);

        if ($stmt->execute()) {
            // Successful update
            $stmt->close();
            header('Location: ../dashboard.php');
        }
    }
}
elseif (isset($_POST["update_design"])) {
    $title = trim($_POST['title']);
    $old_title = trim($_POST['old_title']);
    $old_logo_default = str_replace('functions/', '', $_POST['old_logo_default']);


    $uploadDirectory = 'uploads/';
    if (!file_exists($uploadDirectory)) {
        mkdir($uploadDirectory, 0755, true);
    }

    // Check if a new image was uploaded
    if (isset($_FILES['profile_image1']) && $_FILES['profile_image1']['error'] == UPLOAD_ERR_OK) {
        $temp_name = $_FILES['profile_image1']['tmp_name'];
        $image_name = $_FILES['profile_image1']['name'];
        $new_image_path = $uploadDirectory . $image_name;

        // Move the uploaded image to the "uploads" folder
        move_uploaded_file($temp_name, $new_image_path);
    } else {
        // No new image was uploaded, so keep the current image path
        $new_image_path = $old_logo_default;
    }

    // Check if changes were made before updating
    if ($title !== $old_title || $new_image_path !== $old_logo_default) {
        // Update the supplier in the database
        $sql = "UPDATE ims_designs SET logo = ?, title = ?";
        $stmt = $conn->prepare($sql);

        // Use bind_param to bind parameters with the correct data types
        $stmt->bind_param("ss", $new_image_path, $title);

        if ($stmt->execute()) {
            // Successful update
            $stmt->close();
            mysqli_close($conn);
            header('Location: ../dashboard.php');
        }
    }
}


?>
