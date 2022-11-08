@extends('layouts.backend')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Products Details</h1>
        <a href="{{ route('product.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Show Products</a>
    </div>

    <div class="card">
        <div class="row">
            <div class="col-md-6">
                <div class="images p-3">
                    <div class="text-center p-4"> 
                        <img width="250" src="{{ $product->image != null ? asset('products/images/'.$product->image) : 'https://via.placeholder.com/50' }}" alt="">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="product p-4">
                    <div class="mt-4 mb-3"> 
                        <span class="text-uppercase text-muted brand mb-3">Brand : {{ $product->brand->brand_name }}</span> <br>
                        <span class="text-uppercase text-muted brand mb-3">Category : {{ $product->category->category_name }}</span>
                        <h5 class="text-uppercase">Product Name : {{ $product->product_name }}</h5>
                        <div class="price d-flex flex-row align-items-center mb-3"> 
                            <span class="act-price">Slug : {{  $product->product_slug }}</span>
                        </div>
                        <div class="price d-flex flex-row align-items-center mb-3"> 
                            <span class="act-price">Code : {{  $product->product_code }}</span>
                        </div>
                        <div class="price d-flex flex-row align-items-center mb-3"> 
                            <span class="act-price">Quantity : {{  $product->qty }}</span>
                        </div>
                        <div class="price d-flex flex-row align-items-center mb-3"> 
                            <span class="act-price">Price : {{  $product->price }}</span>
                        </div>
                    </div>
                    
                    <div class="cart mt-4 align-items-center"> <button class="btn btn-danger text-uppercase mr-2 px-4">Add to cart</button> <i class="fa fa-heart text-muted"></i> <i class="fa fa-share-alt text-muted"></i> </div>
                </div>
            </div>
        </div>
    </div>
@endsection