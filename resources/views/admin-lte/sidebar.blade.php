<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset ('adminlte/dist/img/Me.jpeg')}}" class="img-circle elevation-2" alt="User Image")>
      </div>
      <div class="info">
        <a href="#" class="d-block">Yusup Supratman</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
          <a href="{{ url('/dashboard/index') }}" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Data Admin
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ url('/kategori/index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Kategori</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/penulis/index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Penulis</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/penerbit/index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Penerbit</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/buku/index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Buku</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="{{ url('/home') }}" class="nav-link">
            <i class="fas fa-sign-out nav-icon" aria-hidden="true"></i>
            <p>
              Log Out
            </p>
          </a>
        </li>
      </ul>  
    </nav>
    <!-- /.sidebar-menu -->
  </div>