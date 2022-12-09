@extends('layouts.main')

@section('section')
    <div class="container p-5">
        <div class="row">
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @elseif(session()->has('message'))
                <div class="alert alert-danger" role="alert">
                    {{ session('message') }}
                </div>
            @endif
            <div class="col-lg-3 px-2">
                <img src="https://source.unsplash.com/320x400/?Phone" alt="">
            </div>
            <div class="col-9 px-2">
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
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
