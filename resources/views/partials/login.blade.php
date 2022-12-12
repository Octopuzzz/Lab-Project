@extends('layouts.main')

@section('section')
    <div class="container-fluid d-flex p-5 align-items-center justify-content-center" style="background-color: #eee; height: 92vh; ">
        <div class="row shadow-lg w-50 mh-100 m-auto p-0 rounded-4 overflow-hidden">
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @elseif(session()->has('message'))
                <div class="alert alert-danger" role="alert">
                    {{ session('message') }}
                </div>
            @elseif(session('loginError'))
                <div class="alert alert-danger">
                    {{ session('loginError') }}
                </div>
            @endif
            <div class="col-lg-4 p-0 m-0">
                <img class="w-100 h-100 " src="{{ asset('storage/images/Register.jpg') }}" alt="">
            </div>
            <div class="col-lg-8 p-5">
                <h1>Login</h1>
                <form method="POST" action="{{ route('login') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="LoginEmail" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="email" id="LoginEmail" aria-describedby="emailHelp">
                    </div>
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="mb-3">
                        <label for="LoginPassword" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="LoginPassword">
                    </div>
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" name="remember" id="Remember">
                        <label class="form-check-label" for="Remember">Check me out</label>
                    </div>
                    <button type="submit" class="btn btn-danger w-100">Login</button>
                    <a class="d-block mt-2 text-decoration-none" href="{{ route('register') }}">Don't Have Account? Register Here</a>
                </form>
            </div>
        </div>
    </div>
@endsection
