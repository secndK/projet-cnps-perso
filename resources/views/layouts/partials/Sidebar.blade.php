<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        @if (Auth::user()->hasRole('Super Admin'))

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#donnée-nav" aria-expanded="false">
                    <i class="bi bi-database"></i><span>Données et Historiques</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="donnée-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li><a href="{{ route('dashboard') }}" class="hover:bg-sky-500"><i class="bi bi-circle"></i><span>Dashboard</span></a></li>
                    <li><a href="{{ route('logs.index') }}"><i class="bi bi-circle"></i><span>Historique</span></a></li>
                </ul>
            </li>

            <!-- 📌 Gestion des Attributions -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#attribution-nav" aria-expanded="false">
                    <i class="bi bi-clipboard-check"></i><span>Gestion des attributions</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="attribution-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li><a href="{{ route('attributions.index') }}"><i class="bi bi-circle"></i><span>Attributions</span></a></li>
                    <li><a href="#"><i class="bi bi-circle"></i><span>Historique d'attribution</span></a></li>
                </ul>
            </li>

            <!-- 📌 Gestion des accès et rôles -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#roles-nav" aria-expanded="false">
                    <i class="bi bi-sliders"></i><span>Gestion des accès et rôles</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="roles-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li><a href="{{ route('roles.index') }}"><i class="bi bi-circle"></i><span>Rôles</span></a></li>
                    <li><a href="{{ route('permissions.index') }}"><i class="bi bi-circle"></i><span>Permissions</span></a></li>
                    <li><a href="{{ route('users.index') }}"><i class="bi bi-circle"></i><span>Utilisateurs</span></a></li>
                </ul>
            </li>

            <!-- 📌 Gestion des Postes -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#postes-nav" aria-expanded="false">
                    <i class="bi bi-journal-text"></i><span>Gestion des postes</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="postes-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li><a href="{{ route('types-postes.index') }}"><i class="bi bi-circle"></i><span>Types de postes</span></a></li>
                    <li><a href="{{ route('postes.index') }}"><i class="bi bi-circle"></i><span>Poste de travail</span></a></li>
                    <li>
                        <a href="{{ route('postes.historique') }}">
                            <i class="bi bi-clock-history"></i>
                            <span>Historique d'action</span>
                        </a>
                    </li>                </ul>
            </li>
            <!-- 📌 Gestion des Périphériques -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#peripheriques-nav" aria-expanded="false">
                    <i class="bi bi-usb"></i><span>Gestion des périphériques</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="peripheriques-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li><a href="{{ route('types-peripheriques.index') }}"><i class="bi bi-circle"></i><span>Types de périphériques</span></a></li>
                    <li><a href="{{ route('peripheriques.index') }}"><i class="bi bi-circle"></i><span>Périphériques</span></a></li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('dashboard') }}">
                    <i class="bi bi-exclamation-circle"></i>
                    <span>Error 404</span>
                </a>
            </li>

        @else

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('dashboard') }}">
                <i class="bi bi-bar-chart-fill"></i>
                <span>Mon dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('postes.index') }}">
                <i class="bi bi-pc-display"></i>
                <span>Mes Postes de travail</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('peripheriques.index') }}">
                <i class="bi bi-mouse3"></i>
                <span>Mon périphériques</span>
            </a>
        </li>

        @endif

    </ul>

</aside>
