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

  <title>IMS - Stocks</title>

  <link rel="icon" href="../../assets/images/logos/ims.png">

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
              <h5 class="card-title fw-semibold mb-4">Stocks</h5>
              <div class="flex-grow-1"></div>
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
                      <h6 class="fw-semibold mb-0">Serial ID</h6>
                    </th>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0">Image</h6>
                    </th>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0">Product Name</h6>
                    </th>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0">Stocks</h6>
                    </th>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0">Last Updated</h6>
                    </th>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0">Action</h6>
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
                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0"><?php echo $row['product_id']; ?></h6></td>
                    <td class="border-bottom-0">
                        <img src="<?php echo !empty($row['product_image']) ? 'functions/' . $row['product_image'] : 'functions/uploads/default.png'; ?>" alt="Product Image" width="100" height="100">
                    </td>
                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0"><?php echo $row['product_name']; ?></h6></td>
                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0"><?php echo $row['stocks']; ?></h6></td>
                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0"><?php 
                    // Create a new DateTime object from the last updated string
                    $date = new DateTime($row['last_updated']);

                    // Set the timezone of the DateTime object to Manila
                    $date->setTimezone(new DateTimeZone('Asia/Manila'));

                    // Format the DateTime object to the desired format
                    $formattedDate = $date->format('F j, Y'.' @ '.'h:i A');

                    echo $formattedDate; ?></h6></td>
                    <td class="border-bottom-0 text-center">
                        <a href="" class="btn btn-sm btn-primary me-2" data-bs-toggle="modal" data-bs-target="#update-modal<?php echo $row['product_id']; ?>">Update</a>
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
<?php
  $sql = "SELECT * FROM ims_products";
  if($rs=$conn->query($sql)){
      while ($row=$rs->fetch_assoc()) {
        $ims_status = $row["status"];
        $id = $row["product_id"];

  ?>
<!-- Update product -->
<div class="modal fade" id="update-modal<?php echo $row['product_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Product</h1>
      </div>
      <div class="modal-body">
        <div class="row g-2">
          <div class="col-md">
            <form action="functions/update.php" method="post" enctype="multipart/form-data">
            <div class="form-floating">
                <input type="text" name="product_id" class="form-control" id="floatingInputGrid1" value="<?php echo $row['product_id']; ?>" readonly>
                <label for="floatingInputGrid1">Product ID</label>
            </div>
            <div class="form-floating mt-2">
                <input type="text" name="product_name" class="form-control" id="floatingInputGrid" value="<?php echo $row['product_name']; ?>" readonly>
                <label for="floatingInputGrid">Product Name</label>
            </div>
                <?php
                $sql = "SELECT * FROM ims_products WHERE product_id = '$id'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $picture = $row['product_image'];

                    if (!empty($picture)) {
                        // Convert the BLOB data to base64 encoding
                        $src = 'functions/' . $picture;
                    } else {
                        // If the image is not available, show a default image
                        $src = "functions/uploads/default.png";
                    }
                } else {
                    // If no matching record is found, show a default image
                    $src = "functions/uploads/default.png";
                }
            ?>

            <!-- Existing code for displaying the profile picture -->
            <div class="shadow border border-opacity-50 mt-2" style="width: 200px; height: 200px; margin: 0 auto; text-align: center; display: flex; align-items: center; justify-content: center;">
                <img src="<?php echo $src; ?>" style="max-width: 100%; max-height: 100%;" class="profile-image">
            </div>

            <!-- File input to upload the new profile picture -->
            <input type="file" name="profile_image" accept="image/*" class="form-control form-control-sm mt-4 profile-image-input">
            <script>
                document.querySelectorAll('.profile-image-input').forEach(function (fileInput, index) {
                    fileInput.addEventListener('change', function () {
                        var idboxImage = document.querySelectorAll('.profile-image')[index];

                        if (fileInput.files && fileInput.files[0]) {
                            var reader = new FileReader();

                            reader.onload = function (e) {
                                idboxImage.src = e.target.result;
                            };

                            reader.readAsDataURL(fileInput.files[0]);
                        } else {
                            // If no file is selected or selection is canceled, revert to the original profile picture
                            idboxImage.src = '<?php echo $src; ?>';
                        }
                    });
                });
            </script>

            <div class="form-floating mt-2">
                <input type="number" name="stock" min="0" step="1" class="form-control" id="floatingInputGrid" value="<?php echo $row['stocks']; ?>">
                <label for="floatingInputGrid">Stocks</label>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="closeButton" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="update_stocks"><i class="ti ti-device-floppy"></i> Update</button>
      </div>
      </form>
      <script>
        // Add an event listener to all elements with the attribute data-bs-dismiss="modal"
        var closeButtons = document.querySelectorAll('[data-bs-dismiss="modal"]');
        closeButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                window.location.reload(true);
            });
        });
    </script>
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