@extends('layouts.main')

@section('section')
    <div class="container p-5">
        <div class="row">
            <div class="card-header">
                <h1>Create An Account</h1>
            </div>
            <form class="card-body" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="Name" class="form-label">Your Name</label>
                    <input type="text" name="name" class="form-control" id="Name" aria-describedby="emailHelp">
                </div>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="mb-3">
                    <label for="Email1" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" id="Email1" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="mb-3">
                    <label for="Password1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="Password1">
                </div>
                <div class="mb-3">
                    <label for="Confirm-Password1" class="form-label">Confirm Your Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="Confirm-Password1">
                </div>
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                 <div class="mb-3">
                    <label for="Address" class="form-label">Address</label>
                    <input type="text" name="address" class="form-control" id="Address" aria-describedby="emailHelp">
                </div>
                @error('address')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="mb-3 d-flex">
                    <div class="pe-4">
                        <input type="radio" name="gender" id="Male" value="Male" {{ old('gender') == 'Male' ? "checked" : "" }}>
                        <label for="Male">Male</label>
                    </div>
                    <div>
                        <input type="radio" name="gender" id="Female" value="Female" {{ old('gender') == 'Female' ? "checked" : "" }}>
                        <label for="Female">Female</label>
                    </div>
                </div>
                @error('gender')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" name="Agreement" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">I agree all statements in Terms of service</label>
                </div>
                @error('Agreement')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
