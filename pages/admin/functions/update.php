<?php
include '../../../conn.php';

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
    $status = $_POST['status'];

    // Update the product in the database
    $sql = "UPDATE ims_products SET 
            product_name = ?,
            category = ?,
            brand = ?,
            supplier = ?,
            warehouse = ?,
            status = ?
            WHERE product_id = ?";

    $stmt = $conn->prepare($sql);

    // Use bind_param to bind parameters with the correct data types
    $stmt->bind_param("sssssss", $product_name, $category, $brand, $supplier, $warehouse, $status, $product_id);

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
    last_updated = CONVERT_TZ(NOW(), '+00:00', '-06:00')
    WHERE product_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $product_name, $stock, $new_image_path, $product_id);

    if ($stmt->execute()) {
    // Successful update
    $stmt->close();
    mysqli_close($conn);
    header('Location: ../stocks.php');
    }

}


?>
