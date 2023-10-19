<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>IMS - Product</title>

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
              <h5 class="card-title fw-semibold mb-4">Products</h5>
              <div class="flex-grow-1"></div>
              <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                <i class="ti ti-square-plus"></i>
                Add Product
              </button>
            </div>
            <div class="table-responsive">
              <table class="table text-nowrap mb-0 align-middle">
                <thead class="text-dark fs-4">
                  <tr>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0">ID</h6>
                    </th>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0">Assigned</h6>
                    </th>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0">Product Name</h6>
                    </th>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0">Priority</h6>
                    </th>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0">Budget</h6>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0">1</h6></td>
                    <td class="border-bottom-0">
                        <h6 class="fw-semibold mb-1">Jhemar Denuevo</h6>
                        <span class="fw-normal">Web Designer</span>                          
                    </td>
                    <td class="border-bottom-0">
                      <p class="mb-0 fw-normal">Jayniella Morente</p>
                    </td>
                    <td class="border-bottom-0">
                      <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-primary rounded-3 fw-semibold">Low</span>
                      </div>
                    </td>
                    <td class="border-bottom-0">
                      <h6 class="fw-semibold mb-0 fs-4">$3.9</h6>
                    </td>
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
            <div class="form-floating">
              <input type="email" class="form-control" id="floatingInputGrid" placeholder="name@example.com" value="mdo@example.com">
              <label for="floatingInputGrid">Name</label>
            </div>
          </div>
          <div class="col-md">
            <div class="form-floating">
              <select class="form-select" id="floatingSelectGrid">
                <option selected>Category</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
              <label for="floatingSelectGrid">Works with selects</label>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary"><i class="ti ti-device-floppy"></i> Save</button>
      </div>
    </div>
  </div>
</div>


<script src="../../assets/libs/jquery/dist/jquery.min.js"></script>
<script src="../../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/sidebarmenu.js"></script>
<script src="../../assets/js/app.min.js"></script>
<script src="../../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
<script src="../../assets/libs/simplebar/dist/simplebar.js"></script>
<script src="../../assets/js/dashboard.js"></script>

</body>
</html>