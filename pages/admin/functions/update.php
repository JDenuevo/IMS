<?php
include '../../../conn.php';

if (isset($_POST["update_brand"])) {
    // Get the new brand name and brand_id from the form
    $brand_id = $_POST['brand_id'];
    $brand_name = $_POST['brand_name'];

    // Update the brand in the database
    $sql = "UPDATE ims_brand SET brand_name = ? WHERE brand_id = ?";
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
    $sql = "UPDATE ims_category SET category_name = ? WHERE category_id = ?";
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
    $sql = "UPDATE ims_warehouse SET warehouse_name = ?, warehouse_add = ? WHERE warehouse_id = ?";
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
    $sql = "UPDATE ims_supplier SET supplier_name = ?, supplier_add = ?, supplier_email = ? WHERE supplier_id = ?";
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
?>
