@extends('layouts.userLayout')
@section('userContent')

    @include('components.user.emailForm')

    {{-- <section class="text-center mb-5" style="--bs-bg-opacity: .5;" id="particles-js"></section> --}}
    {{-- @if (Auth::check())
        <h3>
            <small>Hello,</small>
            {{ Auth::user()->name }}
            <div class="messageBG py-1">
                <span class="fs-5">Welcome to Bank complaining Web Application</span>
            </div>
        </h3>
    @else
        <script>
            window.location = "/";
        </script>
    @endif --}}
@endsection
