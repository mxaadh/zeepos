@extends('adminlte::auth.auth-page')

@if(session()->has('company_name'))
    @section('auth_header')
        {{ session('company_name') }}
    @endsection
@endif

@section('auth_body')
    <form action="{{ route('login.submit') }}" method="POST">
        @csrf

        {{-- Display general errors --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Username Field --}}
        <div class="input-group mb-3">
            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                   value="{{ old('username') }}" placeholder="Username" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
            </div>
            @error('username')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Password Field --}}
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                   placeholder="Password">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            @error('password')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Submit Button --}}
        <div class="row d-flex align-middle justify-content-center">
            <div class="col-5">
                <button type="submit" class="btn btn-block btn-flat btn-primary">
                    Sign In
                </button>
            </div>
        </div>

        {{-- Forgot Password Link --}}
        @if(Route::has('password.request'))
            <div class="text-center mt-3">
                <a href="{{ route('password.request') }}">Forgot your password?</a>
            </div>
        @endif
    </form>
@endsection
