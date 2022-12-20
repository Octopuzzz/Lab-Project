@extends('layouts.main')

@section('section')
    <div class="container-fluid">

        <table class="table-hover table table-bordered">
            <thead class="table-info">
                <tr>
                    <th colspan="1" scope="">No</th>
                    <th colspan="2">Product Image</th>
                    <th colspan="4">Product Name</th>
                    <th colspan="5">Product Description</th>
                    <th colspan="4">Product Price</th>
                    <th colspan="4">Product Stock</th>
                    <th colspan="3" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($products as $product)
                    <tr>
                        <th colspan="1">
                            {{ $no++}}
                        </th>
                        <th colspan="2">
                            <img src="{{ asset('storage/product-image/'. $product->image ) }}" class="" alt="" style="width: 100px;">
                        </th>
                        <th colspan="4">
                            {{ $product->name }}
                        </th>
                        <th colspan="5">
                            {{ $product->description }}
                        </th>
                        <th colspan="4">
                            {{ $product->price }}
                        </th>
                        <th colspan="4" class="
                        @if($product->stock < 1)
                            text-danger
                        @endif">
                            {{ $product->stock }}
                        </th>
                        <th scope="row" class="">
                            <div class="d-flex justify-content-center align-items-center">
                                <form action="{{ route('editProduct',$product->ProductID) }}" class="me-2 p-0" method="GET" enctype="multipart/form-data">
                                    @csrf
                                    <button class="btn btn-primary">Update</button>
                                </form>
                                <form action="{{ route('removeProduct.dashboard',$product->ProductID) }}" onclick="return confirm('Are you sure delete this product?')" method="POST" class="p-0 m-0">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger" >Delete</button>
                                </form>
                            </div>
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- <div class="modal fade" id="ModalDelete" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are You Sure Want Delete This Product ?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-2">
                            <img src="{{ asset('storage/product-image/'. $product->image ) }}" class="" alt="" style="width: 100px;">
                        </div>
                        <div class="col-lg-10 m-auto">
                            <h3>{{ $product->name }}</h3>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success">Continue</button>
                </div>
                </div>
            </div>
        </div> --}}
    </div>
@endsection
