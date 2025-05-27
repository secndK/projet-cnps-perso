<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        @if (Auth::user()->hasRole('Super Admin'))
            <!-- 📊 Données et Statistiques -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#donnée-nav" aria-expanded="false">
                    <i class="bi bi-database"></i><span>Données et Statistiques</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="donnée-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('dashboard') }}" class="hover:bg-sky-500">
                            <i class="bi bi-graph-up"></i><span>Dashboard</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- 📋 Gestion des Attributions -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#attribution-nav" aria-expanded="false">
                    <i class="bi bi-clipboard-check"></i><span>Gestion des attributions</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="attribution-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('attributions.index') }}">
                            <i class="bi bi-arrow-left-right"></i><span>Attributions</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('attributions.logs') }}">
                            <i class="bi bi-clock-history"></i><span>Historique d'attribution</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- 🛡️ Gestion des Accès et Rôles -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#roles-nav" aria-expanded="false">
                    <i class="bi bi-sliders"></i><span>Gestion des accès et rôles</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="roles-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('roles.index') }}">
                            <i class="bi bi-person-badge"></i><span>Rôles</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('permissions.index') }}">
                            <i class="bi bi-shield-lock"></i><span>Permissions</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('users.index') }}">
                            <i class="bi bi-people"></i><span>Utilisateurs</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- 🖥️ Gestion des postes -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#postes-nav" aria-expanded="false">
                    <i class="bi bi-journal-text"></i><span>Gestion des postes</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="postes-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('types-postes.index') }}">
                            <i class="bi bi-layout-text-sidebar"></i><span>Types de postes</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('postes.index') }}">
                            <i class="bi bi-pc-display"></i><span>Poste de travail</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- 🖨️ Gestion des périphériques -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#peripheriques-nav" aria-expanded="false">
                    <i class="bi bi-usb"></i><span>Gestion des périphériques</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="peripheriques-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('types-peripheriques.index') }}">
                            <i class="bi bi-hdd-stack"></i><span>Types de périphériques</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('peripheriques.index') }}">
                            <i class="bi bi-hdd"></i><span>Périphériques</span>
                        </a>
                    </li>
                </ul>
            </li>

        @else

            <!-- Utilisateur non Super Admin -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#donnée-nav" aria-expanded="false">
                    <i class="bi bi-database"></i><span>Données et Statistiques</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="donnée-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('dashboard') }}" class="hover:bg-sky-500">
                            <i class="bi bi-graph-up"></i><span>Dashboard</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#attribution-nav" aria-expanded="false">
                    <i class="bi bi-clipboard-check"></i><span>Gestion des attributions</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="attribution-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('attributions.index') }}">
                            <i class="bi bi-arrow-left-right"></i><span>Attributions</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('attributions.logs') }}">
                            <i class="bi bi-clock-history"></i><span>Historique d'attribution</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#postes-nav" aria-expanded="false">
                    <i class="bi bi-journal-text"></i><span>Gestion des postes</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="postes-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('types-postes.index') }}">
                            <i class="bi bi-layout-text-sidebar"></i><span>Types de postes</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('postes.index') }}">
                            <i class="bi bi-pc-display"></i><span>Poste de travail</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#peripheriques-nav" aria-expanded="false">
                    <i class="bi bi-usb"></i><span>Gestion des périphériques</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="peripheriques-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('types-peripheriques.index') }}">
                            <i class="bi bi-hdd-stack"></i><span>Types de périphériques</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('peripheriques.index') }}">
                            <i class="bi bi-hdd"></i><span>Périphériques</span>
                        </a>
                    </li>
                </ul>
            </li>

        @endif
    </ul>
</aside>
