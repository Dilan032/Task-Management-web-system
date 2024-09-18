{{-- <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{ route('administrator.index') }}">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('administrator.messages') }}">Messages</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('administrator.users') }}">Users</a>
        </li>
      </ul>
      <div class="d-flex justify-content-end">
        <a href="{{ route('logout') }}" class="btn btn-outline-light">Logout</a>
      </div>
    </div>
  </div>
</nav> --}}
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
                    <a class="nav-link {{ Route::currentRouteName() == 'administrator.index' ? 'active' : '' }}"
                        aria-current="page" href="{{ route('administrator.index') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'administrator.messages' ? 'active' : '' }}"
                        href="{{ route('administrator.messages') }}">Issues Management</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'administrator.users' ? 'active' : '' }}"
                        href="{{ route('administrator.users') }}">Employee Management</a>
                </li>
            </ul>
            <div class="d-flex justify-content-end">
                <a href="{{ route('administrator.logout') }}" class="btn btn-outline-light">Logout</a>
            </div>
            {{-- <div class="dropdown text-start">
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
                    <li><a href="{{ route('administrator.logout') }}" class="active">Logout</a></li>
                </ul>
            </div> --}}
        </div>
    </div>
</nav>
