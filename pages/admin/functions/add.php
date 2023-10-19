<?php
include '../../../conn.php';

if (isset($_POST["save_brand"])) {
   // Get the brand name from the form
    $brand_name = $_POST['brand_name'];

    // Insert the brand name into the database
    $sql = "INSERT INTO ims_brand (brand_name) VALUES ('$brand_name')";
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
     $sql = "INSERT INTO ims_category (category_name) VALUES ('$category_name')";
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
     $sql = "INSERT INTO ims_warehouse (warehouse_name,warehouse_add) VALUES ('$warehouse_name','$warehouse_add')";
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
     $sql = "INSERT INTO ims_supplier (supplier_name,supplier_add,supplier_email) VALUES ('$supplier_name','$supplier_add','$supplier_email')";
     $result = mysqli_query($conn, $sql);
 
     // Close the database connection
     mysqli_close($conn);
 
     // Redirect the user to the previous page
     header('Location: ../supplier.php');
 }
?>