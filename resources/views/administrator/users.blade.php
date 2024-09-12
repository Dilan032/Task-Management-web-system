@extends('layouts.administratorLayout')
@section('administratorContent')

<span class="fs-4 ms-4">users</span>
<hr class="me-3">


{{-- btns for user register model --}}
<div class="d-grid mb-4 justify-content-end">
    <button class="btn btn-primary me-4" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Register Users</button>
</div>
    {{-- include model --}}
    @include('components.superAdmin.users.registerUsers')
    {{-- end user register section --}}

<p class="fs-4 text-center">Institute Administrators</p>
<section class="container bg-white text-dark userBgShado rounded">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr class="text-start">
                    <td scope="col" style="width: 30%">Name</td>
                    <td scope="col" style="width: 30%">Email</td>
                    <td scope="col" class="text-center">Tel</td>
                    <td scope="col" class="text-center">Status</td>
                    <td scope="col"></td>
                    <td scope="col"></td>
                  </tr>
              </thead>
              <tbody class="table-group-divider">
                {{-- @if ($institute->isNotEmpty()) --}}
                    @foreach ($institute as $instituteDetails)
                        @if ($users->isNotEmpty())
                            @foreach ($users as $userDetails)
                                @if ($instituteDetails->id == $userDetails->institute_id && $userDetails->user_type == "administrator" )
                                    <tr class="text-start fw-lighter">
                                        <td scope="col" style="width: 30%">{{ $userDetails->name }}</td>
                                        <td scope="col" style="width: 30%">{{ $userDetails->email }}</td>
                                        <td scope="col" class="text-center">{{ $userDetails->user_contact_num }}</td>
                                        <td scope="col" class="text-center">
                                            @if ($userDetails->status == "active")
                                                <span class="badge text-bg-success px-4">{{ $userDetails->status }}</span>
                                            @else
                                                <span class="badge text-bg-secondary px-3">{{ $userDetails->status }}</span>
                                            @endif  
                                        </td>
                                        <td class="text-end">
                                            <a href="{{ route('user.details',$userDetails->id) }}" type="button" class="btn btn-outline-primary btn-sm">
                                                <small>Manage</small>
                                            </a>
                                        </td>
                                        <td class="text-start">
                                            <form action="{{ route('user.delete', $userDetails->id ) }}" method="post">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?');">
                                                    <small>Remove</small>
                                                </button>
                                             </form>
                                        </td>
                                      </tr>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                {{-- @endif --}}
              </tbody>
        </table>
      </div>
</section>


<p class="fs-4 text-center mt-5">Institute Employees</p>
<section class="container bg-white text-dark userBgShado rounded">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr class="text-start">
                    <td scope="col" style="width: 30%">Name</td>
                    <td scope="col" style="width: 30%">Email</td>
                    <td scope="col" class="text-center">Tel</td>
                    <td scope="col" class="text-center">Status</td>
                    <td scope="col"></td>
                    <td scope="col"></td>
                  </tr>
              </thead>
              <tbody class="table-group-divider">
                {{-- @if ($Institute->isNotEmpty()) --}}
                    @foreach ($institute as $instituteDetails)
                        @if ($users->isNotEmpty())
                            @foreach ($users as $userDetails)
                                @if ($instituteDetails->id == $userDetails->institute_id && $userDetails->user_type == "user" )
                                    <tr class="text-start fw-lighter">
                                        <td scope="col" style="width: 30%">{{ $userDetails->name }}</td>
                                        <td scope="col" style="width: 30%">{{ $userDetails->email }}</td>
                                        <td scope="col" class="text-center">{{ $userDetails->user_contact_num }}</td>
                                        <td scope="col" class="text-center">
                                            @if ($userDetails->status == "active")
                                                <span class="badge text-bg-success px-4 mt-2">{{ $userDetails->status }}</span>
                                            @else
                                                <span class="badge text-bg-secondary px-3 mt-2">{{ $userDetails->status }}</span>
                                            @endif  
                                        </td>
                                        <td class="text-end">
                                            <a href="{{ route('user.details',$userDetails->id) }}" type="button" class="btn btn-outline-primary btn-sm">
                                                <small>Manage</small>
                                            </a>                     
                                        </td>
                                        <td class="text-start">
                                            <form action="{{ route('user.delete', $userDetails->id ) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?');">
                                                    <small>Remove</small>
                                                </button>
                                            </form>
                                        </td>
                                      </tr>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                {{-- @endif --}}
              </tbody>
        </table>
      </div>
</section>

@endsection