<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#donnée-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-usb"></i><span>Données et Historiques</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="donnée-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li><a href="{{ route('dashboard') }}"><i class="bi bi-circle"></i><span>Dashboard</span></a></li>
                <li><a href="{{ route('logs.index') }}"><i class="bi bi-circle"></i><span>Logs</span></a></li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#roles-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-sliders"></i><span>Gestion des accès et attributions</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="roles-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li><a href="{{ route('roles.index') }}"><i class="bi bi-circle"></i><span>Rôles</span></a></li>
                <li><a href="{{ route('permissions.index') }}"><i class="bi bi-circle"></i><span>Permissions</span></a></li>
                <li><a href="{{ route('users.index') }}"><i class="bi bi-circle"></i><span>Utilisateurs</span></a></li>
                <li><a href="{{ route('attributions.index') }}"><i class="bi bi-circle"></i><span>Attributions</span></a></li>

            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#postes-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Gestion des postes</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="postes-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li><a href="{{ route('types-postes.index') }}"><i class="bi bi-circle"></i><span>Types de postes</span></a></li>
                <li><a href="{{ route('postes.index') }}"><i class="bi bi-circle"></i><span>Poste de travail</span></a></li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#peripheriques-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-usb"></i><span>Gestion des périphériques</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="peripheriques-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li><a href="{{ route('types-peripheriques.index') }}"><i class="bi bi-circle"></i><span>Types de périphériques</span></a></li>
                <li><a href="{{ route('peripheriques.index') }}"><i class="bi bi-circle"></i><span>Périphériques</span></a></li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('dashboard') }}">
                <i class="bi bi-dash-circle"></i>
                <span>Error 404</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-blank.html">
                <i class="bi bi-file-earmark"></i>
                <span>Blank</span>
            </a>
        </li>
    </ul>
</aside>
