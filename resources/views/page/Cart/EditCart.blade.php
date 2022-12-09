@extends('layouts.main')

@section('section')
<div class="d-flex justify-content-center align-items-center p-5">
    <div class="col-lg-8 border p-5 main-section bg-white rounded-4 shadow-lg" style="background-color: #eee">
        <div class="row m-0 ">
            <div class="col-lg-4 left-side-product-box pb-3">
                <div style="max-height:500px; overflow:hidden">
                    <img src="https://source.unsplash.com/1600x900/?{{ $Product->name }}" class="border border-0 p-3 img-fluid">
                </div>
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
                            <h5>{{ $Product->year }}</h5>
                            <span>{!! $Product->description !!}</span>
                            <hr >
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form action="{{ route('updateCart',$item->CardID) }}" method="POST">
                                        @csrf
                                        <div class="col-lg-12 mb-2">
                                            <input type="number" class="form-control text-center" name="quantity" min="1" value="{{ $item->Quantity }}">
                                        </div>
                                        <button class="btn btn-success form-control">
                                            Update Quantity, <span>{{ $item->CardID }}</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
