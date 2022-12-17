@extends('layouts.main')

@section('section')
    <div class="container-fluid py-5 d-flex" style="background-color: #eee; height: 94vh;">
        <div class="row rounded-4 shadow-lg d-flex m-auto p-0 w-50 overflow-hidden">
            <div class="col-lg-12 p-5" style="background-color: #F8F9FA;">
                    <div class="card-header">
                        <h1>Create An Product</h1>
                    </div>
                    <form class="card-body" method="POST" action="{{ route('addProduct') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <input type="text" placeholder="Product Name" name="ProductName" class="form-control rounded-pill" id="Name" aria-describedby="emailHelp" value="{{ old('ProductName') }}">
                        </div>
                        @error('ProductName')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="mb-3">
                            <textarea name="ProductDescription" placeholder="Product Description" class="form-control rounded-4"value="{{ old('ProductDescription') }}"></textarea>
                        </div>
                        @error('ProductDescription')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="mb-3">
                            <input type="text" placeholder="Product Price" name="ProductPrice" class="form-control rounded-pill" aria-describedby="emailHelp" value="{{ old('ProductPrice') }}">
                        </div>
                        @error('ProductPrice')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="mb-3">
                            <input type="text" placeholder="Year" name="Year" class="form-control rounded-pill" aria-describedby="emailHelp" value="{{ old('Year') }}">
                        </div>
                        @error('Year')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="mb-3">
                            <input type="number" min="1" placeholder="Stock" name="Stock" class="form-control rounded-pill" aria-describedby="emailHelp" value="{{ old('Stock') }}">
                        </div>
                        @error('Stock')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="col-lg-12 mb-4">
                            <label for="images" class="form-label">Upload Image</label>
                            <input type="file" name="image" class="form-control rounded-pill" id="images">
                        </div>
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <button type="submit" class="btn btn-danger rounded-pill w-100">Add Product</button>
                        </span>
                    </form>
            </div>
        </div>
    </div>

@endsection
