<?php
  include '../../conn.php';

  $sql5 = "SELECT * FROM ims_designs";
  $result5 = $conn->query($sql5);

  if ($result5->num_rows > 0) {
    $row5 = $result5->fetch_assoc();
    $logo = $row5['logo'];
    $title = $row5['title'];

        if (!empty($logo)) {
          // Convert the BLOB data to base64 encoding
          $logo_default = '../admin/functions/' . $logo;
      } else {
          // If the image is not available, show a default image
          $logo_default = "../admin/functions/uploads/default.png";
      }
    } else {
    // If no matching record is found, show a default image
    $logo_default = "../admin/functions/uploads/default.png";
    }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="<?php echo $logo_default; ?>">

  <title><?php echo $title; ?></title>



  <!-- Main Template -->
  <link rel="stylesheet" href="../../assets/css/styles.min.css">

</head>

<body>

  <!--  Main wrapper -->
  <div class="body-wrapper">
      <div class="container-fluid">
        <div class="card w-100">
          <div class="card-body p-4">
          <div class="row">
          <div class="d-flex justify-content-end">
            <a class="btn btn-danger" href="../" role="button">Sign in as Admin</a>
          </div>
          <div class="d-flex justify-content-center align-items-center">
              <h5 class="card-title fw-bold mb-4" style="font-size: 30px;">Products</h5>
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
                      <h6 class="fw-semibold mb-0 text-center">Description</h6>
                    </th>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0 text-center">Category</h6>
                    </th>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0 text-center">Brand</h6>
                    </th>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0 text-center">Stocks</h6>
                  </tr>
                </thead>
                <tbody>
                <?php
                    $sql = "SELECT * FROM ims_products WHERE status = 'Usable'";
                    if($rs=$conn->query($sql)){
                        while ($row=$rs->fetch_assoc()) {
                    ?>
                  <tr>
                    <td class="border-bottom-0 text-center"><h6 class="fw-semibold mb-0"><?php echo $row['product_id']; ?></h6></td>
                    <td class="border-bottom-0 text-center"><h6 class="fw-semibold mb-0"><?php echo $row['product_name']; ?></h6></td>
                    <td class="border-bottom-0 text-center"><h6 class="fw-semibold mb-0"><?php echo $row['product_description']; ?></h6></td>
                    <td class="border-bottom-0 text-center"><h6 class="fw-semibold mb-0"><?php echo $row['category']; ?></h6></td>
                    <td class="border-bottom-0 text-center"><h6 class="fw-semibold mb-0"><?php echo $row['brand']; ?></h6></td>
                    <td class="border-bottom-0 text-center">
                    <h6 class="fw-semibold mb-0">
                            <?php
                            if ($row['stocks'] == 0) {
                                echo "OUT OF STOCK";
                            } else {
                                echo $row['stocks'];
                            }
                            ?>
                        </h6>
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