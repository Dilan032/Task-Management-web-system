<style>
    /* Ensure this CSS is loaded last to override other styles */
    .nav-link {
        color: black;
        /* Default color */
    }

    .nav-link.active,
    .nav-link.active:hover {
        color: blue !important;
        /* Color when active */
    }

    .nav-item{
        margin-left:10px;
        margin-right:10px;
    }
</style>

<!-- Navbar (Visible only for Super Admins) -->
@if (auth()->user() && auth()->user()->user_type === 'super admin')
    <nav class="navbar navbar-expand-lg" style="background-color: #ececec;">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01"
                aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <img class="d-flex justify-content-end" style="width: 70px; margin-left:10px"
                src="{{ asset('images/CompanyLogo/nanosoftSolutions Company Logo.png') }}" alt="NanosoftSolutions Logo">

            <div class="collapse navbar-collapse" id="navbarTogglerDemo01" style="margin-top: 10px">
                {{-- Navgation links --}}
                <ul class="nav nav-underline me-auto mb-2 mb-lg-0" style=" margin-left:40px;">
                    <li class="nav-item mb-2">
                        <a class="nav-link {{ Route::currentRouteName() == 'superAdmin.dashboard' ? 'active' : '' }} aria-current="page"
                            href="{{ route('superAdmin.dashboard') }} ">Dashboard</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link {{ Route::currentRouteName() == 'superAdmin.allmessages.view' ? 'active' : '' }} aria-current="page"
                            href="{{ route('superAdmin.allmessages.view') }}">All Issues</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link {{ Route::currentRouteName() == 'superAdmin.users.view' ? 'active' : '' }} aria-current="page"
                            href="{{ route('superAdmin.users.view') }}">Company Users Management</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link {{ Route::currentRouteName() == 'superAdmin.institute.view' ? 'active' : '' }} aria-current="page"
                            href="{{ route('superAdmin.institute.view') }}">Institute Management</a>
                    </li>
                </ul>

                <ul class="nav nav-underline flex-column mb-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark" href="#" id="userDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                <path fill-rule="evenodd"
                                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                            </svg>
                        </a>
                        <!-- Dropdown menu with conditional alignment -->
                        <ul class="dropdown-menu dropdown-menu-lg-end dropdown-menu-md-end dropdown-menu-sm-end"
                            aria-labelledby="userDropdown">
                            <div style="text-align:center; font-size:17px; font-weight: bold;">
                                @if (Auth::check())
                                    <span>
                                        {{ Auth::user()->name }}
                                    </span>
                                @else
                                    <script>
                                        window.location = "/";
                                    </script>
                                @endif
                            </div>
                            <hr>
                            <!-- Change account details option -->
                            <li>
                                <a class="dropdown-item" href="{{ route('super.admin.change.password') }}">
                                    Change Account Details
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <!-- Logout option -->
                            <li>
                                <a class="dropdown-item" href="{{ route('administrator.logout') }}">
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
@endif


<!-- Navbar (Visible only for company employees) -->
@if (auth()->user() && auth()->user()->user_type === 'company employee')
    <nav class="navbar navbar-expand-lg" style="background-color: #ececec;">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <img class="d-flex justify-content-end" style="width: 70px; margin-left:10px"
                src="{{ asset('images/CompanyLogo/nanosoftSolutions Company Logo.png') }}"
                alt="NanosoftSolutions Logo">

            <div class="collapse navbar-collapse" id="navbarTogglerDemo01" style="margin-top: 10px">
                <ul class="nav nav-underline me-auto mb-2 mb-lg-0" style="margin-left:40px;">
                    <li class="nav-item mb-2">
                        <a class="nav-link {{ Route::currentRouteName() == 'company.employee.dashboard' ? 'active' : '' }}"
                            aria-current="page" href="{{ route('company.employee.dashboard') }}">Dashboard</a>
                    </li>
                </ul>

                <ul class="nav nav-underline flex-column mb-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark" href="#" id="userDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                <path fill-rule="evenodd"
                                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                            </svg>
                        </a>
                        <!-- Dropdown menu with conditional alignment -->
                        <ul class="dropdown-menu dropdown-menu-lg-end dropdown-menu-md-end dropdown-menu-sm-end"
                            aria-labelledby="userDropdown">
                            <div style="text-align:center; font-size:17px; font-weight: bold;">
                                @if (Auth::check())
                                    <span>
                                        {{ Auth::user()->name }}
                                    </span>
                                @else
                                    <script>
                                        window.location = "/";
                                    </script>
                                @endif
                            </div>
                            <hr>
                            <!-- Change account details option -->
                            <li>
                                <a class="dropdown-item" href="{{ route('change.password') }}">
                                    Change Password
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <!-- Logout option -->
                            <li>
                                <a class="dropdown-item" href="{{ route('user.logout') }}">
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
@endif


<!-- Navbar (Visible only for administrator)  - Institute Side-->
@if (auth()->user() && auth()->user()->user_type === 'administrator')
    <nav class="navbar navbar-expand-lg" style="background-color: #ececec;">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <img class="d-flex justify-content-end" style="width: 70px; margin-left:10px"
                src="{{ asset('images/CompanyLogo/nanosoftSolutions Company Logo.png') }}"
                alt="NanosoftSolutions Logo">

            <div class="collapse navbar-collapse" id="navbarTogglerDemo01" style="margin-top: 10px">
                <ul class="nav nav-underline me-auto mb-2 mb-lg-0" style="margin-left:40px;">
                    <li class="nav-item mb-2">
                        <a class="nav-link {{ Route::currentRouteName() == 'administrator.index' ? 'active' : '' }}"
                            aria-current="page" href="{{ route('administrator.index') }}">Dashboard</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link {{ Route::currentRouteName() == 'administrator.messages' ? 'active' : '' }}"
                            aria-current="page" href="{{ route('administrator.messages') }}">Issues Management</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link {{ Route::currentRouteName() == 'administrator.users' ? 'active' : '' }}"
                            aria-current="page" href="{{ route('administrator.users') }}">Employee Management</a>
                    </li>
                </ul>

                <ul class="nav nav-underline flex-column mb-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark" href="#" id="userDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                <path fill-rule="evenodd"
                                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                            </svg>
                        </a>
                        <!-- Dropdown menu with conditional alignment -->
                        <ul class="dropdown-menu dropdown-menu-lg-end dropdown-menu-md-end dropdown-menu-sm-end"
                            aria-labelledby="userDropdown">
                            <div style="text-align:center; font-size:17px; font-weight: bold;">
                                @if (Auth::check())
                                    <span>
                                        {{ Auth::user()->name }}
                                    </span>
                                @else
                                    <script>
                                        window.location = "/";
                                    </script>
                                @endif
                            </div>
                            <hr>
                            <!-- Change account details option -->
                            <li>
                                <a class="dropdown-item" href="{{ route('administrator.change.password') }}">
                                    Change Password
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <!-- Logout option -->
                            <li>
                                <a class="dropdown-item" href="{{ route('administrator.logout') }}">
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
@endif


<!-- Navbar (Visible only for institute employees)  - Institute Side-->
@if (auth()->user() && auth()->user()->user_type === 'user')
    <nav class="navbar navbar-expand-lg" style="background-color: #ececec;">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <img class="d-flex justify-content-end" style="width: 70px; margin-left:10px"
                src="{{ asset('images/CompanyLogo/nanosoftSolutions Company Logo.png') }}"
                alt="NanosoftSolutions Logo">

            <div class="collapse navbar-collapse" id="navbarTogglerDemo01" style="margin-top: 10px">
                <ul class="nav nav-underline me-auto mb-2 mb-lg-0" style="margin-left:40px;">
                    <li class="nav-item mb-2">
                        <a class="nav-link {{ Route::currentRouteName() == 'user.index' ? 'active' : '' }}"
                            aria-current="page" href="{{ route('user.index') }}">Dashboard</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link {{ Route::currentRouteName() == 'user.previous.messages' ? 'active' : '' }}"
                            aria-current="page" href="{{ route('user.previous.messages') }}">Previous messages</a>
                    </li>
                </ul>

                <ul class="nav nav-underline flex-column mb-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark" href="#" id="userDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                <path fill-rule="evenodd"
                                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                            </svg>
                        </a>
                        <!-- Dropdown menu with conditional alignment -->
                        <ul class="dropdown-menu dropdown-menu-lg-end dropdown-menu-md-end dropdown-menu-sm-end"
                            aria-labelledby="userDropdown">
                            <div style="text-align:center; font-size:17px; font-weight: bold;">
                                @if (Auth::check())
                                    <span>
                                        {{ Auth::user()->name }}
                                    </span>
                                @else
                                    <script>
                                        window.location = "/";
                                    </script>
                                @endif
                            </div>
                            <hr>
                            <!-- Change account details option -->
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    Change Password
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <!-- Logout option -->
                            <li>
                                <a class="dropdown-item" href="{{ route('user.logout') }}">
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
@endif
