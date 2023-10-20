<?php
include '../../../conn.php';

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
    $serialNumber = "SN-$year-$month-$day-$randomNumber";
    
    return $serialNumber;
}

if (isset($_POST["save_brand"])) {
   // Get the brand name from the form
    $brand_name = $_POST['brand_name'];

    // Insert the brand name into the database
    $sql = "INSERT INTO ims_brands (brand_name) VALUES ('$brand_name')";
    $result = mysqli_query($conn, $sql);

    // Close the database connection
    mysqli_close($conn);

    // Redirect the user to the previous page
    header('Location: ../brand.php');
}
elseif (isset($_POST["save_category"])) {
    // Get the category name from the form
     $category_name = $_POST['category_name'];
 
     // Insert the category name into the database
     $sql = "INSERT INTO ims_categories (category_name) VALUES ('$category_name')";
     $result = mysqli_query($conn, $sql);
 
     // Close the database connection
     mysqli_close($conn);
 
     // Redirect the user to the previous page
     header('Location: ../category.php');
 }
 elseif (isset($_POST["save_warehouse"])) {
    // Get the warehouse name from the form
     $warehouse_name = $_POST['warehouse_name'];
     $warehouse_add = $_POST['warehouse_add'];
     // Insert the category name into the database
     $sql = "INSERT INTO ims_warehouses (warehouse_name,warehouse_add) VALUES ('$warehouse_name','$warehouse_add')";
     $result = mysqli_query($conn, $sql);
 
     // Close the database connection
     mysqli_close($conn);
 
     // Redirect the user to the previous page
     header('Location: ../warehouse.php');
 }
 elseif (isset($_POST["save_supplier"])) {
    // Get the supplier name from the form
     $supplier_name = $_POST['supplier_name'];
     $supplier_add = $_POST['supplier_add'];
     $supplier_email = $_POST['supplier_email'];
     // Insert the category name into the database
     $sql = "INSERT INTO ims_suppliers (supplier_name,supplier_add,supplier_email) VALUES ('$supplier_name','$supplier_add','$supplier_email')";
     $result = mysqli_query($conn, $sql);
 
     // Close the database connection
     mysqli_close($conn);
 
     // Redirect the user to the previous page
     header('Location: ../supplier.php');
 }
 elseif (isset($_POST["save_product"])) {
    $product_id = generateSerialNumber();
    $product_name = $_POST['product_name'];
    $category = isset($_POST['category']) ? $_POST['category'] : null;
    $brand = isset($_POST['brand']) ? $_POST['brand'] : null;
    $supplier = isset($_POST['supplier']) ? $_POST['supplier'] : null;
    $warehouse = $_POST['warehouse'];
    $status = $_POST['status'];

    $sql = "INSERT INTO ims_products (product_id,product_name,category,brand,supplier,warehouse,status) 
     VALUES ('$product_id','$product_name','$category','$brand','$supplier','$warehouse','$status')";
    $result = mysqli_query($conn, $sql);

    // Close the database connection
    mysqli_close($conn);

    // Redirect the user to the previous page
    header('Location: ../product.php');
}
?>