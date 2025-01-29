<nav class="flex flex-col items-center sidebar">
        <header class="flex flex-row items-center space-x-4"
                <div class="">
                    <img src="{{ asset("img/cnps_z.png") }}" alt="logo cnps" width="150px" height="150px">
                </div>
                <div class="text header-text">
                    <span class="name">CNPS Project</span>
                </div>
        </header>
        <div class="menu-bar">
                <div class="menu">
                    <ul class="menu-links">
                        @if (!Auth::user()->hasRole('Super Admin'))
                            <li class="nav-link">
                                    <a href="#" class="nav-link active">
                                        <i class="fa-solid fa-gauge"></i>
                                        <span class="text nav-text">Dashboard</span>
                                    </a>
                            </li>
                            <li class="nav-link">
                                <a  href="#" class="nav-link">
                                    <i class="fa-solid fa-users"></i>
                                    <span class="text nav-text">Gestion des utilisateurs</span>
                                </a>
                            </li>
                            <li class="nav-link">
                                <a  href="#"  class="nav-link">
                                    <i class="fa-solid fa-computer"></i>
                                    <span class="text nav-text">Gestion des équipements</span>
                                </a>
                            </li>
                    </ul>
                        @else
                        <li class="nav-link">
                            <a  href="#" class="nav-link active">
                                <i class="fa-solid fa-gauge"></i>
                                <span class="text nav-text"> Mon Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-link">
                            <a  href="#" class="nav-link">
                                <i class="fa-solid fa-gear"></i>
                                <span class="text nav-text">Paramètre</span>
                            </a>
                        </li>
                    @endif
                </div>
                <div class="bottom-content">
                    <li class="">
                        <a  href="#">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            <span class="text nav-text">Deconnexion</span>
                        </a>
                    </li>
                </div>
        </div>
    </nav>
    <!-- I have not failed. I've just found 10,000 ways that won't work. - Thomas Edison -->

