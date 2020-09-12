@extends('layouts.basic')

@section('auth')
    <br>
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
            <div class="text-center">
                @auth
                    <a class="btn btn-secondary"  href="{{ route('logout', app()->getLocale()) }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <br>
                    <br>
                    <a class="btn btn-success" href="{{ route('fields') }}">Fields List</a>
                    <a class="btn btn-primary" href="{{ route('products') }}">Products List</a>
                    <br>
                    <br>
                    <a class="btn btn-warning" href="{{ route('email_form') }}">Send Email</a>
                    <br>
                    <br>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Register</a>
                @endauth
            </div>
        @endif
    </div>
@endsection
