<nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
    <div class="container-fluid">

      <img class="p-2 rounded-circle bg-white me-2" style="width: 70px;" src="{{ asset('images/CompanyLogo/nanosoftSolutions Company Logo.png') }}" alt="NanosoftSolutions Logo">
      
      <a class="navbar-brand fs-3" href="#"><span class="fs-1">N</span>anoSoft Solutions</a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="bi bi-list fs-1"></i>
      </button>
    
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            {{-- <a class="nav-link active" aria-current="page" href="{{ route('user.index') }}">Home</a> --}}
          </li>
          <li class="nav-item">
            {{-- <a class="nav-link" href="{{ route('user.index') }}">Previous messages</a> --}}
          </li>
        </ul>
        {{-- <div class="d-flex flex-row-reverse text-center "> --}}
          <div class="dropdown text-start">
            <a class="px-5 py-1 text-white fs-5 fw-normal"  data-bs-toggle="dropdown" aria-expanded="false">
              @if(Auth::check())
                  <span>
                    {{ Auth::user()->name }} 
                    <i class="bi bi-caret-down-fill"></i>
                  </span> <br>
              @else
                  <script>window.location = "/";</script>
              @endif
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-center">
              <li><a class="dropdown-item" href="{{ route('change.password') }}">Change Password</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a href="{{route('user.logout')}}" class="active">Logout</a></li>
            </ul>
          </div>
        {{-- </div> --}}
      </div>
    </div>
  </nav>