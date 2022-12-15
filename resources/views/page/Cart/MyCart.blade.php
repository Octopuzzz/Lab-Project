@extends('layouts.main')

@section('section')
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(count($items) == 0)
        <h1 class="mt-4">
            My Cart
        </h1>
            <div class="d-flex justify-content-center align-items-center p-5">
                <div class="col-lg-8 border p-5 main-section bg-white rounded-4 shadow-lg" style="background-color: #eee">
                    <div class="row m-0 ">
                        <div class="col-lg-12">
                            <h1 class="text-center">Your Cart is Empty</h1>
                        </div>
                        <div class="col-lg-12">
                            <a href="{{ route('home')  }}" class="btn btn-danger w-100">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            @php
                $total = 0;
            @endphp
            @foreach ($items as $item)
                <div class="container border px-5 mt-4 py-2 main-section bg-white rounded-4 shadow-lg" style="background-color: #eee">
                    <div class="row">
                        @if ($item->products[0]->image)
                            <div class="col-lg-4">
                                <img src="{{ asset('storage/product-image/'.$item->products[0]->image) }}" class="border border-0 p-3 img-thumbnail">
                            </div>
                        @else
                            <div class="col-lg-4">
                                <img src="https://source.unsplash.com/1600x900/?{{ $item->name }}" class="border border-0 p-3 img-thumbnail">
                            </div>
                        @endif
                        <div class="col-lg-8 py-3">
                            <div class="row">
                                <div class="col-lg-8 py-3">
                                    <div class="col-lg-12">
                                        <h1>{{ $item->products[0]->name }}</h1>
                                    </div>
                                    <div class="col-lg-12">
                                        <h4 class="">{{ $item->products[0]->year }}</h4>
                                    </div>
                                    <div class="col-lg-12">
                                        <h6>Rp. {{ $item->Price }}</h6>
                                    </div>
                                    <div class="col-lg-12">
                                        <h6 class="text-danger">{{ $item->Quantity }} (Pcs)</h6>
                                    </div>
                                    <div class="col-lg-12">
                                        <p>{{ Str::limit($item->products[0]->description, 120, '...') }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-4 m-auto">
                                    <div class="row">
                                        <div class="col-lg-12 mb-2">
                                            <form action="{{ route('editCart',$item->CardID) }}" method="GET" enctype="multipart/form-data">
                                                @csrf
                                                <button class="btn btn-primary w-100">Edit Product</button>
                                            </form>
                                        </div>
                                        <div class="col-lg-12 mt-2">
                                            <form action="{{ route('remove',$item->CardID) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <button class="btn btn-danger w-100">Remove</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @php
                    $total += $item->TotalPrice;
                @endphp
            @endforeach
            <hr class="">
            <div class="d-flex justify-content-between pe-4 ps-1 py-4">
                <h3 class="ms-4" name="Total_Price">Total : Rp. {{ $total }}</h3>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Checkout({{ count($items)  }})
                </button>
            </div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form action="{{ route('checkout', $total) }}" method="POST" enctype="multipart/form-data" class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                @csrf
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Are You Sure Want To Checkout ?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <ol>
                                @foreach ($items as $item)
                                    <li>
                                        <span>{{ $item->products[0]->name }}</span>
                                    </li>
                                @endforeach
                            </ol>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Continue</button>
                        </div>
                    </div>
                </div>
            </form>
        @endif
    </div>
@endsection
