@extends('layouts.basic')

@section('auth')
    <div class="flex-center position-ref full-height">

        @if (Route::has('login'))
            <div class="text-center">

                @auth

                    <a  class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                @else
                    <a class="btn btn-primary" href="{{ route('login') }}">Login</a>
                    <a class="btn btn-primary" href="{{ route('register') }}">Register</a>
                @endauth

            </div>
        @endif

    </div>
@endsection

