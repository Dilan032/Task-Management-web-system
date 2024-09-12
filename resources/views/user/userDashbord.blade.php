@extends('layouts.userLayout')
@section('userContent')

        <section class="text-center mb-5" style="--bs-bg-opacity: .5;" id="particles-js">
                @if(Auth::check())
                        <h3>
                                <small>Hello,</small>
                                {{ Auth::user()->name }}
                                <div class="messageBG py-1">
                                        <span class="fs-5">Welcome to Bank complaining Web Application</span>
                                </div>
                        </h3>    
                @else
                        <script>window.location = "/";</script>
                @endif
        </section>

        @include('components.user.emailForm')

        <hr class="my-5">

        <div class="mb-5">
             <p class="fs-4 mb-3 text-center">Previous messages</p>
             @include('components.user.previousMessages')
        </div>
    
@endsection