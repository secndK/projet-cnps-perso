<nav class="app-header navbar navbar-expand-md shadow-sm bg-body ">
    <!--begin::Container-->
    <div class="container-fluid ">
      <!--begin::Start Navbar Links-->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
            <i class="bi bi-list"></i>
          </a>
        </li>

        <li class="nav-item">

        </li>
      </ul>
      <!--end::Start Navbar Links-->
      <!--begin::End Navbar Links-->
      <ul class="navbar-nav ms-auto">

        <div class="btn-group">
            <a href="#" class="dropdown-toggle " type="button" data-bs-toggle="dropdown"  aria-expanded="false">
                {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <ul class="dropdown-menu dropdown-menu-lg-end">
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="{{ route('logout') }}"" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Deconnexion</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </ul>
        </div>



      </ul>
      <!--end::End Navbar Links-->
    </div>
    <!--end::Container-->
  </nav>
  <!--end::Header-->
