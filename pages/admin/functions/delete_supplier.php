<?php
include '../../../conn.php';

$id = $_GET['id'];

$sql = "DELETE FROM ims_supplier WHERE supplier_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id); // "i" specifies that $id is an integer

$stmt->execute();

// Redirect the user to the previous page
header('Location: ../supplier.php');

$stmt->close(); // Close the prepared statement
$conn->close(); // Close the database connection

?>