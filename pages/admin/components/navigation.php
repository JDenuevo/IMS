<!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="./dashboard.php" class="text-nowrap logo-img">
            <?php include 'logo_display.php'; ?>
            <div style="display: inline-block; vertical-align: middle;">
              <label class="fs-6 ms-3 fw-bold">IMS'youu</label>
            </div>
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>

        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">GENERAL</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./dashboard.php" aria-expanded="false">
                <span>
                  <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./product.php" aria-expanded="false">
                <span>
                  <i class="ti ti-box-seam"></i>
                </span>
                <span class="hide-menu">Products</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./brand.php" aria-expanded="false">
                <span>
                  <i class="ti ti-brand-appgallery"></i>
                </span>
                <span class="hide-menu">Brands</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./category.php" aria-expanded="false">
                <span>
                  <i class="ti ti-category"></i>
                </span>
                <span class="hide-menu">Categories</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./warehouse.php" aria-expanded="false">
                <span>
                  <i class="ti ti-building-warehouse"></i>
                </span>
                <span class="hide-menu">Warehouse</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./supplier.php" aria-expanded="false">
                <span>
                    <i class="ti ti-chart-bar"></i>
                </span>
                <span class="hide-menu">Supplier</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">REPORTS</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./stocks.php" aria-expanded="false">
                <span>
                  <i class="ti ti-packages"></i>
                </span>
                <span class="hide-menu">Stocks</span>
              </a>
            </li>
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->