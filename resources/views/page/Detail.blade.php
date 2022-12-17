@extends('layouts.main')


@section('section')
@if (session('success'))
    <div class="container mt-4 pb-0">
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    </div>
@endif
<div class="d-flex justify-content-center align-items-center p-5">
    <div class="col-lg-8 border p-5 main-section bg-white rounded-4 shadow-lg" style="background-color: #eee">
        <div class="row m-0 ">
            <div class="col-lg-4 left-side-product-box pb-3">
                @if ($Product->image)
                    <div style="max-height:500px; overflow:hidden">
                        <img src="{{ asset('storage/product-image/'.$Product->image) }}" class="border border-0 p-3 img-fluid">
                    </div>
                @else
                    <div style="max-height:500px; overflow:hidden">
                        <img src="https://source.unsplash.com/1600x900/?{{ $Product->name }}" class="border border-0 p-3 img-fluid">
                    </div>
                @endif
            </div>
            <div class="col-lg-8 ">
                <div class="right-side-pro-detail border p-3 m-0 pb-4 rounded">
                    <div class="row">
                        <div class="col-lg-12">
                            <span>By . <a href="/users/{{ $Product->user->name }}" class="text-decoration-none"></a>{{ $Product->user->name }}</span>
                            <p class="m-0 p-0">Women's Velvet Dress</p>
                        </div>
                        <div class="col-lg-12">
                            <p class="m-0 p-0 price-pro">Rp. {{ $Product->price }}</p>
                            <hr class="p-0 m-0">
                        </div>
                        <div class="col-lg-12 pt-2">
                            <div class="d-flex justify-content-between">
                                <h5>Released at : {{ $Product->year }}</h5>
                                <h5 class="">Stock : <span class="
                                    @if($Product->stock < 1)
                                    text-danger
                                    @endif">{{ $Product->stock }}</span></h5>
                            </div>
                            <span>{!! $Product->description !!}</span>
                            <hr >
                        </div>
                        @if(Auth::check() == false || Auth::user()->isAdmin != 1 )
                            <div class="col-lg-12">
                                <h6>Buy :</h6>
                                <form action="{{ route('add', $Product->ProductID) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12 mb-2">
                                            <input type="number" class="form-control text-center" name="quantity" min="1" max="{{ $Product->stock }}" value="1">
                                        </div>
                                        <div class="col-lg-12"
                                        @if ($Product->stock < 1)
                                             disabled
                                        @endif
                                        >
                                            <button type="submit" class="btn btn-success w-100">Add to Cart</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif
                        @can('admin')
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <a href="{{ route('home') }}" class="btn btn-danger w-100">Back</a>
                                    </div>
                                    <div class="col-lg-6">
                                        <form action="{{ route('removeProduct', $Product->ProductID) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger form-control" onclick="return confirm('Are you sure delete this product?')">
                                                Delete Item
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

