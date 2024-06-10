@extends('app')

@section('title', 'Iniciar Sesión')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>

            <br>
            <br><br>
            <br>
            <br>
            <br>
            <br>
            <div class="card bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card-body p-6 text-gray-900 dark:text-gray-100">
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')"/>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Address -->
                        <div class="mb-3" style="color: #081527 ">
                            <x-input-label for="email" :value="__('Email')"/>
                            <x-text-input id="email" class="form-control mt-1 w-full" type="email" name="email"
                                          :value="old('email')" required autofocus autocomplete="username"/>
                            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                        </div>

                        <!-- Password -->
                        <div class="mb-3 mt-4" style="color: #081527">
                            <x-input-label for="password" :value="__('Password')"/>
                            <x-text-input id="password" class="form-control mt-1 w-full" type="password" name="password"
                                          required autocomplete="current-password"/>
                            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                        </div>

                        <!-- Remember Me -->
                        <div class="form-check mt-4">
                            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                            <label for="remember_me"
                                   class="form-check-label ms-2 text-sm text-gray-600 dark:text-gray-400">{{
                                __('Remember me') }}</label>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                               href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                            @endif

                            <x-primary-button class="btn btn-primary ms-3">
                                {{ __('Log in') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<br>
<br>

@endsection
