@extends('layouts.main')

@section('section')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Home</h1>
            </div>
        </div>
        <div class="row">
        @if(session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @elseif(session()->has('message'))
            <div class="alert alert-danger" role="alert">
                {{ session('message') }}
            </div>
        @endif
        @foreach($Products as $Product)
            <div class="col-lg-4 py-3">
                <div class="card" style="">
                    <img src="{{ asset('storage/product-image/'.$Product->image) }}" class="card-img-top img-fluid" alt="..." style="height: 300px;">
                    <div class="card-body">
                        <div class="row">
                            <h5 class="card-title col-lg-8">{{ $Product->name }}</h5>
                            <p class="col-lg-4 text-lg-end" href="">{{ $Product->year }}</p>
                        </div>
                        <p class="card-text">${{ $Product->price }}</p>
                        <a href="{{ route('product', $Product->ProductID) }}" class="btn btn-primary">View Product</a>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
        {{  $Products->links()  }}
    </div>
@endsection
