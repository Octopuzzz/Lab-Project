@extends('layouts.main')

@section('section')
    <div class="container-fluid py-5" style="background-color: #bec0bc;">
        <div class="row border border rounded-4 shadow-lg m-auto w-75"style="background-color: #eee;">
            <div class="col-4">
                <img src="" alt="">
            </div>
            <div class="col-8 p-5">
                    <div class="card-header">
                        <h1>Create An Account</h1>
                    </div>
                    <form class="card-body" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="Name" class="form-label">Your Name</label>
                            <input type="text" name="name" class="form-control" id="Name" aria-describedby="emailHelp" value="{{ old('name') }}">
                        </div>
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="mb-3">
                            <label for="Email1" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" id="Email1" aria-describedby="emailHelp" value="{{ old('email') }}">
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
                            <input type="text" name="address" class="form-control" id="Address" aria-describedby="emailHelp" value="{{ old('address') }}">
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
                        <div class="col-lg-12 mb-4">
                            <label for="images" class="form-label">Upload Image</label>
                            <input type="file" name="image" class="form-control rounded-pill" id="images">
                        </div>
                        @error('image')
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
                        <a class="d-block mt-2 text-decoration-none">Don't Have Account? Register Here</a>
                    </form>

            </div>
        </div>
    </div>
@endsection
