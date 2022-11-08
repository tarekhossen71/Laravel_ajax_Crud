@extends('layouts.backend')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Products Edit</h1>
        <a href="{{ route('product.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Show Products</a>
    </div>

    <div class="card shadow">
        {{-- Alert --}}
        @include('dashboard.include.alert')
        <form action="{{ route('product.update',$product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xl-8">
                    <div class="card m-2">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Product Name</label>
                                <input type="text" name="product_name" class="form-control" id="product_name" value="{{ $product->product_name }}">
                                @error('product_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="product_slug" class="form-label">Product Slug</label>
                                <input type="text" name="product_slug" class="form-control" id="product_slug" value="{{ $product->product_slug }}">
                                @error('product_slug')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="product_code" class="form-label">Product Code</label>
                                <input type="text" name="product_code" class="form-control" id="product_code" value="{{ $product->product_code }}">
                                @error('product_code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="qty" class="form-label">Quantity</label>
                                <input type="text" name="qty" class="form-control" id="qty" value="{{ $product->qty }}">
                                @error('qty')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="text" name="price" class="form-control" id="price" value="{{ $product->price }}">
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Future Image</label>
                                <input type="file" name="image" class="form-control" id="image" >
                                
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <img width="50" height="50" src="{{ $product->image != null ? asset('products/images/'.$product->image) : 'https://via.placeholder.com/50' }}">
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card m-2">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="brand" class="form-label">Brand</label>
                                <select name="brand_id" class="form-select" id="brand">
                                    <option value="">-Select Brand-</option>
                                    @forelse ($data['brands'] as $brand)
                                        <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->brand_name }}</option>
                                    @empty
                                        <span class="text-danger">Sorry, Brand Not Found!</span>
                                    @endforelse
                                </select>
                                @error('brand_id')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select name="category_id" class="form-select" id="category">
                                    <option value="">-Select Category-</option>
                                    @forelse ($data['categories'] as $category)
                                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                                    @empty
                                        <span class="text-danger">Sorry, Category Not Found!</span>
                                    @endforelse
                                </select>
                                @error('category_id')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" class="form-select" id="status">
                                    <option value="">-Select Status-</option>
                                    <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Pending</option>
                                    <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Published</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="text-end">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-sm btn-outline-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection