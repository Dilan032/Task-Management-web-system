
    {{-- <div class="row">
        <div class="col-auto min-vh-100 bg-dark position-fixed z-3 d-none d-sm-inline">
            <div class="pt-4 pb-2 px-2">
                <a href="" class="nav-link text-white">
                    <i class="bi bi-list fs-2 me-2 ms-2"></i>
                    <span class="fs-3 d-none d-sm-inline">SuperAdmin</span>
                    <br>
                </a>
            </div>

            <hr class="text-white">

            <ul class="nav nav-pills flex-column mb-auto p-2">
                <li class="nav-item mb-2">
                    <a href="{{route('superAdmin.dashbord')}}" class="nav-link text-white ">
                        <i class="bi bi-speedometer me-2 ms-2"></i>
                        <span class="d-none d-sm-inline">Dashbord</span>
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{route('superAdmin.messages.view')}}" class="nav-link text-white">
                        <i class="bi bi-chat-left-dots me-2 ms-2"></i>
                        <span class="d-none d-sm-inline">Messages</span>
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{route('superAdmin.users.view')}}" class="nav-link text-white">
                        <i class="bi bi-person-circle me-2 ms-2"></i>
                        <span class="d-none d-sm-inline">Users</span>
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{route('superAdmin.banks.view')}}" class="nav-link text-white">
                        <i class="bi bi-bank me-2 ms-2"></i>
                        <span class="d-none d-sm-inline">Banks</span>
                    </a>
                </li>
            </ul>

            <hr class="text-white" style="margin-top:85%">

            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="{{route('superAdmin.logout')}}" class="nav-link text-white">
                        <i class="bi bi-box-arrow-right me-2 ms-4"></i>
                        <span class="d-none d-sm-inline">LogOut</span>
                    </a>
                </li>
            </ul>

        </div>
    </div> --}}


{{-- in mobile view show this side bar --}}
<i class="bi bi-list fs-1 ms-4 mt-2 mouse-hand" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"></i>

<div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
  <div class="offcanvas-header">
    <h4 class="offcanvas-title" id="offcanvasScrollingLabel">SuperAdmin</h4>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">

    <h6>Institute Complaning Web Application</h6>

    <hr class="text-dark">

    <ul class="nav nav-pills flex-column mb-auto p-2">
        <li class="nav-item mb-2">
            <a href="{{ route('superAdmin.dashbord') }}" class="nav-link text-dark ">
                <i class="bi bi-speedometer"></i>
                <span>Dashbord</span>
            </a>
        </li>
        {{-- <li class="nav-item mb-2">
            <a href="{{ route('superAdmin.messages.view') }}" class="nav-link text-dark">
                <i class="bi bi-chat-left-dots"></i>
                <span>Messages</span>
            </a>
        </li> --}}
        <li class="nav-item mb-2">
            <a href="{{ route('superAdmin.allmessages.view') }}" class="nav-link text-dark">
                <i class="bi bi-chat-left-dots"></i>
                <span>All Messages</span>
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('superAdmin.users.view') }}" class="nav-link text-dark">
                <i class="bi bi-person-circle"></i>
                <span>Users</span>
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('superAdmin.institute.view') }}" class="nav-link text-dark">
                <i class="bi bi-person-circle"></i>
                <span>Institutes</span>
            </a>
        </li>
    </ul>

    <hr class="text-dark">

    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{route('administrator.logout')}}" class="nav-link text-dark">
                <i class="bi bi-box-arrow-right"></i>
                <span>LogOut</span>
            </a>
        </li>
    </ul>


  </div>
</div>
