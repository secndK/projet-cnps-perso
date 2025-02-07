<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('dashboard') }}">
                <i class="bi bi-clipboard-data"></i>
              <span>Dashboard</span>
            </a>
        </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-sliders"></i><span>Gestion des accès</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('roles.index') }}">
              <i class="bi bi-circle"></i><span>Rôles</span>
            </a>
          </li>
          <li>
            <a href="{{ route('permissions.index') }}">
              <i class="bi bi-circle"></i><span>Permissions</span>
            </a>
          </li>

          <li>
            <a href="{{ route('users.index') }}">
              <i class="bi bi-circle"></i><span>Utilisateurs</span>
            </a>
          </li>
        </ul>
      </li>


      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Gestion des actifs</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="{{ route('postes.index') }}">
                  <i class="bi bi-circle"></i><span>Poste de travail</span>
                </a>
              </li>

              <li>
                <a href="{{ route('peripheriques.index') }}">
                  <i class="bi bi-circle"></i><span>Peripherique</span>
                </a>
              </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('dashboard') }}">
          <i class="bi bi-dash-circle"></i>
          <span>Error 404</span>
        </a>
      </li><!-- End Error 404 Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-blank.html">
          <i class="bi bi-file-earmark"></i>
          <span>Blank</span>
        </a>
      </li>

      <!-- End Blank Page Nav -->


      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-blank.html">
          <i class="bi bi-file-earmark"></i>
          <span>Blank</span>
        </a>
      </li>





    </ul>

  </aside><!-- End Sidebar-->
