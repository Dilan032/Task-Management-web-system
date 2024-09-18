<nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
    <div class="container-fluid">

        <img class="p-1 rounded-circle bg-white me-4" style="width: 70px;"
            src="{{ asset('images/CompanyLogo/nanosoftSolutions Company Logo.png') }}" alt="NanosoftSolutions Logo">




        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-list fs-1"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 mt-3 fs-6">
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'user.index' ? 'active' : '' }}"
                        aria-current="page" href="{{ route('user.index') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'user.previous.messages' ? 'active' : '' }}"
                        href="{{ route('user.previous.messages') }}">Previous messages</a>
                </li>

            </ul>
            <div class="dropdown text-start">
                <a class="px-5 py-1 text-white" data-bs-toggle="dropdown" aria-expanded="false">
                    @if (Auth::check())
                        <span class="fs-5 me-1">{{ Auth::user()->name }}</span>
                        <i class="bi bi-caret-down-fill fs-5"></i>
                    @else
                        <script>
                            window.location = "/";
                        </script>
                    @endif
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-center">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Change Password</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a href="{{ route('user.logout') }}" class="active">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
