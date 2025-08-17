@extends('adminlte::auth.auth-page')


@section('auth_header')
    Salient Features
@endsection

@section('auth_body')
    <form action="{{ route('connect.connection') }}" method="POST">
        @csrf
        <div class="input-group mb-3">
            <input type="text" name="client" class="form-control "
                   value="" placeholder="Client Selection" autofocus>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-link "></span>
                </div>
            </div>
        </div>

        <div class="row d-flex align-middle justify-content-center">
            <div class="col-5">
                <button type=submit class="btn btn-block btn-flat btn-primary">
                    <span class="fas fa-sign-in-alt"></span>
                    Connect
                </button>
            </div>
        </div>
    </form>
@endsection
