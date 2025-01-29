<aside class="shadow app-sidebar bg-body-secondary" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
      <!--begin::Brand Link-->
      <a href="../index.html" class="brand-link">
        <!--begin::Brand Image-->
        <img
          src="../../../dist/assets/img/AdminLTELogo.png"
          alt="AdminLTE Logo"
          class="shadow opacity-75 brand-image"
        />
        <!--end::Brand Image-->
        <!--begin::Brand Text-->
        <span class="brand-text fw-light">AdminLTE 4</span>
        <!--end::Brand Text-->
      </a>
      <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->

    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
      <nav class="mt-2">
        <!--begin::Sidebar Menu-->
        <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

        @if (Auth::user()->hasRole('Super Admin'))

          <li class="nav-header">DONNÉE ET STATISTIQUES</li>
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="nav-icon bi bi-ui-checks-grid "></i>
                    <p>Dashboard</p>
                </a>
            </li>

            <li class="nav-header">GESTION DES ACCES</li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon bi bi-ui-checks-grid "></i>
                    <p>Rôles</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('permissions.index') }}" class="nav-link">
                    <i class="nav-icon bi bi-ui-checks-grid "></i>
                    <p>Permissions</p>
                </a>
            </li>
        @else

        <li class="nav-header">DONNÉE ET STATISTIQUES</li>
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="nav-icon bi bi-ui-checks-grid "></i>
                    <p>Mon dashboard</p>
                </a>
            </li>

            <li class="nav-header">OUTILS</li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon bi bi-ui-checks-grid "></i>
                    <p>EQUIPEMENTS</p>
                </a>
            </li>

        @endif

        </ul>
        <!--end::Sidebar Menu-->
      </nav>

    </div>
    <!--end::Sidebar Wrapper-->
  </aside>
