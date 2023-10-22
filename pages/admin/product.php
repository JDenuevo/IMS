<?php

session_start();

include '../../conn.php';

if(!isset($_SESSION["loggedinasadmin"]) || $_SESSION["loggedinasadmin"] !== true){
    header("location: ../../index.php");
    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>IMS - Product</title>

  <?php include 'components/icon.php'; ?>

  <!-- Main Template -->
  <link rel="stylesheet" href="../../assets/css/styles.min.css">

</head>

<body>

<?php include '../admin/components/navigation.php'; ?>

  <!--  Main wrapper -->
  <div class="body-wrapper">

    <?php include '../admin/components/header.php'; ?>

      <div class="container-fluid">
        <div class="card w-100">
          <div class="card-body p-4">
            <div class="d-flex">
              <h5 class="card-title fw-semibold mb-4">Products</h5>
              <div class="flex-grow-1"></div>
              <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                <i class="ti ti-square-plus fs-6"></i>
                Add Product
              </button>
            </div>
            <div class="mb-3">
                <label for="searchInput" class="form-label">Search:</label>
                <input type="text" class="form-control" id="searchInput" onkeyup="searchTable()" placeholder="Enter search terms">
            </div>
            <div class="table-responsive">
              <table id="myTable" class="table text-nowrap mb-0 align-middle" >
                <thead class="text-dark fs-4">
                  <tr>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0 text-center">Serial ID</h6>
                    </th>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0 text-center">Product Name</h6>
                    </th>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0 text-center">Category</h6>
                    </th>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0 text-center">Brand</h6>
                    </th>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0 text-center">Supplier</h6>
                    </th>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0 text-center">Warehouse</h6>
                    </th>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0 text-center">Action</h6>
                    </th>
                  </tr>
                </thead>
                <tbody>
                <?php
                    $sql = "SELECT * FROM ims_products";
                    if($rs=$conn->query($sql)){
                        while ($row=$rs->fetch_assoc()) {
                    ?>
                  <tr>
                    <td class="border-bottom-0 text-center"><h6 class="fw-semibold mb-0"><?php echo $row['product_id']; ?></h6></td>
                    <td class="border-bottom-0 text-center"><h6 class="fw-semibold mb-0"><?php echo $row['product_name']; ?></h6></td>
                    <td class="border-bottom-0 text-center"><h6 class="fw-semibold mb-0"><?php echo $row['category']; ?></h6></td>
                    <td class="border-bottom-0 text-center"><h6 class="fw-semibold mb-0"><?php echo $row['brand']; ?></h6></td>
                    <td class="border-bottom-0 text-center"><h6 class="fw-semibold mb-0"><?php echo $row['supplier']; ?></h6></td>
                    <td class="border-bottom-0 text-center"><h6 class="fw-semibold mb-0"><?php echo $row['warehouse']; ?></h6></td>
                    <td class="border-bottom-0 d-flex justify-content-center align-items-center">
                        <a href="" class="btn btn-sm btn-primary me-2" data-bs-toggle="modal" data-bs-target="#update-modal<?php echo $row['product_id']; ?>"><i class="ti ti-edit fs-3"></i> Update</a>
                        <a href="functions/delete_product.php?id=<?php echo $row['product_id']; ?>" class="btn btn-sm btn-danger"><i class="ti ti-trash fs-3"></i> Delete</a>
                    </td>
                    <?php
                            }
                            }
                          ?>
                  </tr>      
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>





  </div>
</div>

<!-- Add Product -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add a Product</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row g-2">
          <div class="col-md">
            <form action="functions/add.php" method="post">
              <div class="form-floating">
                <input type="text" name="product_name" class="form-control" id="floatingInputGrid" required>
                <label for="floatingInputGrid">Product Name</label>
              </div>
              <div class="form-floating mt-2">
                <select name="category" class="form-select" id="categorySelect">
                  <option value="" disabled selected>Select a category</option>
                  <?php
                  $sql = "SELECT * FROM ims_categories";
                  $result = mysqli_query($conn, $sql);
                  while ($row = mysqli_fetch_assoc($result)) {
                    $categoryName = $row['category_name'];

                    echo "<option value=\"$categoryName\">$categoryName</option>";
                  }
                  ?>
                </select>
                <label for="categorySelect">Category</label>
              </div>
              <div class="form-floating mt-2">
                <select name="brand" class="form-select" id="brandSelect">
                  <option value="" disabled selected>Select a brand</option>
                  <?php
                  $sql = "SELECT * FROM ims_brands";
                  $result = mysqli_query($conn, $sql);
                  while ($row = mysqli_fetch_assoc($result)) {
                    $brandName = $row['brand_name']; 

                    echo "<option value=\"$brandName\">$brandName</option>";
                  }
                  ?>
                </select>
                <label for="brandSelect">Brand</label>
              </div>
              <div class="form-floating mt-2">
                <select name="supplier" class="form-select" id="supplierSelect">
                  <option value="" disabled selected>Select a supplier</option>
                  <?php
                  $sql = "SELECT * FROM ims_suppliers";
                  $result = mysqli_query($conn, $sql);
                  while ($row = mysqli_fetch_assoc($result)) {
                    $supplierName = $row['supplier_name']; 

                    echo "<option value=\"$supplierName\">$supplierName</option>";
                  }
                  ?>
                </select>
                <label for="supplierSelect">Supplier</label>
              </div>
              <div class="form-floating mt-2">
                <select name="warehouse" class="form-select" id="warehouseSelect" required>
                  <option value="" disabled selected>Select a warehouse</option>
                  <?php
                  $sql = "SELECT * FROM ims_warehouses";
                  $result = mysqli_query($conn, $sql);
                  while ($row = mysqli_fetch_assoc($result)) {
                    $warehouseName = $row['warehouse_name']; 

                    echo "<option value=\"$warehouseName\">$warehouseName</option>";
                  }
                  ?>
                </select>
                <label for="warehouseSelect">Warehouse</label>
              </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="ti ti-x fs-3"></i> Close</button>
        <button type="submit" class="btn btn-primary" name="save_product"><i class="ti ti-device-floppy fs-3"></i> Save</button>
      </div>
    </form> <!-- Close the form here -->
    </div>
  </div>
</div>

<?php
  $sql = "SELECT * FROM ims_products";
  if($rs=$conn->query($sql)){
      while ($row=$rs->fetch_assoc()) {

  ?>
<!-- Update product -->
<div class="modal fade" id="update-modal<?php echo $row['product_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Product</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row g-2">
          <div class="col-md">
            <form action="functions/update.php" method="post">
            <div class="form-floating">
                <input type="text" name="product_id" class="form-control" id="floatingInputGrid1" value="<?php echo $row['product_id']; ?>" readonly>
                <label for="floatingInputGrid1">Product ID</label>
            </div>
            <div class="form-floating mt-2">
                <input type="text" name="old_product_name" class="form-control" id="floatingInputGrid" value="<?php echo $row['product_name']; ?>" readonly hidden>
                <input type="text" name="product_name" class="form-control" id="floatingInputGrid" value="<?php echo $row['product_name']; ?>" required>
                <label for="floatingInputGrid">Product Name</label>
              </div>
              <div class="form-floating mt-2">
              <select name="category" class="form-select" id="categorySelect">
                      <option value="" disabled>Select a category</option>
                      <?php
                      $selectedCategory = ""; // The category you want to check (e.g., from the database)

                      $sql = "SELECT * FROM ims_categories";
                      $result = mysqli_query($conn, $sql);

                      while ($row = mysqli_fetch_assoc($result)) {
                          $categoryName = $row['category_name'];

                          echo '<option value="' . $categoryName . '"';
                          if ($selectedCategory == $categoryName) {
                              echo ' selected';
                          }
                          echo '>' . $categoryName . '</option>';
                      }
                      ?>
                  </select>
                <label for="categorySelect">Category</label>
              </div>
              <div class="form-floating mt-2">
              <select name="brand" class="form-select" id="brandSelect">
                    <option value="" disabled>Select a brand</option>
                    <?php
                    $selectedBrand = ""; 

                    $sql = "SELECT * FROM ims_brands";
                    $result = mysqli_query($conn, $sql);
                    
                    while ($row = mysqli_fetch_assoc($result)) {
                        $brandName = $row['brand_name'];

                        echo '<option value="' . $brandName . '"';
                        
                        // Check if the current option's value matches the selected brand
                        if ($selectedBrand == $brandName) {
                            echo ' selected';
                        }
                        
                        echo '>' . $brandName . '</option>';
                    }
                    ?>
                </select>
                <label for="brandSelect">Brand</label>
              </div>
              <div class="form-floating mt-2">
              <select name="supplier" class="form-select" id="supplierSelect">
                    <option value="" disabled>Select a supplier</option>
                    <?php
                    $selectedSupplier = ""; 

                    $sql = "SELECT * FROM ims_suppliers";
                    $result = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_assoc($result)) {
                        $supplierName = $row['supplier_name'];

                        echo '<option value="' . $supplierName . '"';

                        // Check if the current option's value matches the selected supplier
                        if ($selectedSupplier == $supplierName) {
                            echo ' selected';
                        }

                        echo '>' . $supplierName . '</option>';
                    }
                    ?>
                </select>
                <label for="supplierSelect">Supplier</label>
              </div>
              <div class="form-floating mt-2">
              <select name="warehouse" class="form-select" id="warehouseSelect" required>
                    <option value="" disabled>Select a warehouse</option>
                    <?php
                    $selectedWarehouse = "";

                    $sql = "SELECT * FROM ims_warehouses";
                    $result = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_assoc($result)) {
                        $warehouseName = $row['warehouse_name'];

                        echo '<option value="' . $warehouseName . '"';

                        // Check if the current option's value matches the selected warehouse
                        if ($selectedWarehouse == $warehouseName) {
                            echo ' selected';
                        }

                        echo '>' . $warehouseName . '</option>';
                    }
                    ?>
                </select>
                <label for="warehouseSelect">Warehouse</label>
              </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="ti ti-x fs-3"></i> Close</button>
        <button type="submit" class="btn btn-primary" name="update_product"><i class="ti ti-device-floppy fs-3"></i> Update</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php
    }
    }
  ?>

<script>
    function searchTable() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toUpperCase();
        const table = document.getElementById('myTable');
        const rows = table.getElementsByTagName('tr');

        for (let i = 1; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
            let found = false;

            for (let j = 0; j < cells.length; j++) {
                const cell = cells[j];
                if (cell) {
                    const textValue = cell.textContent || cell.innerText;

                    if (textValue.toUpperCase().indexOf(filter) > -1) {
                        found = true;
                        break;
                    }
                }
            }

            if (found) {
                rows[i].style.display = '';
                rows[i].classList.remove('highlight');
            } else {
                rows[i].style.display = 'none';
            }
        }
    }
</script>
<script src="../../assets/libs/jquery/dist/jquery.min.js"></script>
<script src="../../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/sidebarmenu.js"></script>
<script src="../../assets/js/app.min.js"></script>
<script src="../../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
<script src="../../assets/libs/simplebar/dist/simplebar.js"></script>
<script src="../../assets/js/dashboard.js"></script>

</body>
</html>