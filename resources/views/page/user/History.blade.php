@extends('layouts.main')

@section('section')
    <div class="container-fluid">
        <h1 class="container px-5 py-3">History Transaction</h1>
        @if (count($item) == 0)
            <div class="d-flex justify-content-center align-items-center p-5">
                <div class="col-lg-8 border p-5 main-section bg-white rounded-4 shadow-lg" style="background-color: #eee">
                    <div class="row m-0 ">
                        <div class="col-lg-12">
                            <h1 class="text-center">Your History is Empty</h1>
                        </div>
                        <div class="col-lg-12">
                            <a href="{{ route('home')  }}" class="btn btn-danger w-100">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            @foreach ($item as $Item)
                <div class="container border px-5 mb-4 py-2 main-section" style="background-color: #eee">
                    <div class="row my-3">
                        <span class="">Purchased <span class="text-danger">On</span> {{ $Item->created_at }}</span>
                    </div>
                        @foreach ($Item->transactionDetails as $product)
                            <div class="row bg-white rounded-1 mx-3 px-2 mb-1 mt shadow-lg">
                                <div class="col-lg-2">
                                    <img src="{{ asset('storage/product-image/'.$product->product->image) }}" class="img-fluid" alt="">
                                </div>
                                <div class="col-lg-10 py-3">
                                    <div class="row">
                                        <div class="col-lg-8 py-3">
                                            <div class="col-lg-12">
                                                <h1>{{ $product->product->name }}</h1>
                                            </div>
                                            <div class="col-lg-12">
                                                <h6 class="text-danger">{{ $product->Quantity }} (Pcs)</h6>
                                            </div>
                                            <div class="col-lg-12">
                                                <h6 class="text-danger">Rp. {{ $product->product->price }}</h6>
                                            </div>
                                            <div class="col-lg-12">
                                                <p>{{ Str::limit($product->product->description, 50, '...') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    <h5 class="py-2 mt-3" name="Total_Price">Total Transaction Cost :
                        <span class="text-danger"> Rp. {{ $Item->Total_Price }}</span>
                    </h5>
                </div>
            @endforeach
        @endif
    </div>
@endsection
