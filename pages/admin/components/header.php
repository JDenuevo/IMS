<!--  Header Start -->

<header class="app-header">
  <nav class="navbar navbar-expand-lg navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item d-block d-xl-none">
        <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
          <i class="ti ti-menu-2"></i>
        </a>
      </li>
    </ul>
    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
      <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">

        <div class="btn-group">
          <a class="nav-link nav-icon-hover cursor-pointer" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="../../assets/images/profile/gmar.jpg" alt="" width="35" height="35" class="rounded-circle">
          </a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up">
            <li>
              <button class="d-flex align-items-center gap-2 dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#update-modal">
                <i class="ti ti-mail fs-6"></i>
                <p class="mb-0 fs-3">My Account</p>
              </button>
            </li>
            <li>
              <button class="d-flex align-items-center gap-2 dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#update-system">
                <i class="ti ti-settings fs-6"></i>
                <p class="mb-0 fs-3">System Modification</p>
              </button>
            </li>
            <li>
              <a href="logout.php" class="btn btn-outline-primary mx-3 mt-2 d-block"><i class="ti ti-logout"></i> Logout</a>
            </li>
          </ul>
        </div>
      </ul>
    </div>
  </nav>
</header>
<!--  Header End -->

<div class="modal fade" id="update-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="update-modal-label">Update My Account</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-floating mb-3">
          <input type="" class="form-control" id="" placeholder="Username">
          <label for="floatingInput">Username</label>
        </div>
        <div class="form-floating">
          <input type="password" class="form-control" id="" placeholder="Password">
          <label for="floatingPassword">Password</label>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="ti ti-x fs-3"></i> Close</button>
        <button type="button" class="btn btn-primary"><i class="ti ti-edit fs-3"></i> Update</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="update-system" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="update-modal-label">Update System</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="text-center">
          <div class="d-flex justify-content-center align-items-center">
            <div class="">
              <img src="../../assets/images/logos/ims.png" alt="" width="100" height="100" class="rounded">
            </div>
          </div>
          <label class="form-label mt-2">Choose a file to change system logo.</label>
          <div class="d-flex justify-content-center align-items-center">
            <div class="file">
              <input class="form-control form-control-sm" id="" type="file">
            </div>
          </div>
          <label class="form-label mt-4">Change system name</label>
          <input class="form-control" type="text" placeholder="IMS'youu" value="IMS'youu" aria-label="">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="ti ti-x fs-3"></i> Close</button>
        <button type="button" class="btn btn-primary"><i class="ti ti-edit fs-3"></i> Update</button>
      </div>
    </div>
  </div>
</div>
