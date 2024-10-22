<nav class="navbar navbar-expand navbar-light bg-gradient-primary topbar mb-4 static-top">
  <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
    <i class="fa fa-bars"></i>
  </button>
  <span><b style="color: var(--secondaryColor);">Setting</b></span>
  <div class="nav-item dropdown no-arrow ml-auto" style="color: white; display: flex; justify-content: space-around; align-items: center;">
    <i class="fas fa-cog nav-link dropdown-toggle ml-5" data-toggle="dropdown" style="cursor: pointer;"></i>
    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
      <a class="dropdown-item logout" href="#">
      <i class="fas fa-power-off fa-fw mr-2" style="color: var(--textColor);"></i>
        Logout
      </a>
    </div>
  </div>
</nav>

<!-- popup logout option -->
<div class="popupConfirmLogout">
  <div class="form-box">
  <div class="logout-header" style="margin-bottom: 10px;">
          <h2>Logout from here?</h2>
      </div>
      <div class="logout-btn">
        <a href="../teacher/logout.php"><button class="confirm-btn yes-btn">Yes</button></a>
        <button class="confirm-btn no-btn">No</button>
      </div>
  </div>
</div>