@extends('layouts.main')

@section('section')
    <div class="container border px-5 py-4 mt-4 main-section bg-white rounded-4 shadow-lg" style="background-color: #eee">
        <div class="row mb-3">
            <img src="https://source.unsplash.com/1600x900/?{{ $user->UserID }}" class="m-auto py-2 img-fluid rounded-circle" alt="" style="width: 200px; height: 200px;">
        </div>
        <form action="{{ route('profile.edit') }}" method="POST" class="row">
            @csrf
            <div class="col-lg-12 mb-4">
                <label for="profile-name class="form-label">Profile Name</label>
                <input type="text" name="name" class="form-control rounded-pill" id="profile-name" value="{{ $user->name }}">
            </div>
            <div class="col-lg-12 mb-4">
                <label for="profile-name" class="form-label">Profile Email</label>
                <input type="text" name="email" class="form-control rounded-pill" id="profile-email" value="{{ $user->email }}">
            </div>
            <div class="col-lg-12 mb-4">
                <label for="profile-name" class="form-label">Profile Address</label>
                <input type="text" name="address" class="form-control rounded-pill" id="profile-address" value="{{ $user->address }}">
            </div>
            <div class="col-lg-12 mb-4">
                <label for="password" class="form-label">New Password</label>
                <input type="password" name="new_password" class="form-control rounded-pill" id="password">
            </div>
            <div class="col-lg-12 mb-4">
                <label for="password_confirmation" class="form-label">Current Confirmation</label>
                <input type="password" name="current_password" class="form-control rounded-pill" id="password_confirmation">
            </div>
            <div class="col-lg-12 mb-3">
                <button class="btn btn-danger col-lg-12 rounded-pill">Edit Profile</button>
            </div>
        </form>
    </div>
@endsection

