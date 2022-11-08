@extends('layouts.backend')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Products</h1>
        <a href="{{ route('product.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Show Products</a>
    </div>

    <div class="card shadow">
        {{-- Alert --}}
        @include('dashboard.include.alert')
        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xl-8">
                    <div class="card m-2">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Product Name</label>
                                <input type="text" name="product_name" class="form-control" id="product_name" value="{{ old('product_name') }}">
                                @error('product_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="product_slug" class="form-label">Product Slug</label>
                                <input type="text" name="product_slug" class="form-control" id="product_slug" value="{{ old('product_slug') }}">
                                @error('product_slug')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="product_code" class="form-label">Product Code</label>
                                <input type="text" name="product_code" class="form-control" id="product_code" value="{{ old('product_code') }}">
                                @error('product_code')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="qty" class="form-label">Quantity</label>
                                <input type="text" name="qty" class="form-control" id="qty" value="{{ old('qty') }}">
                                @error('qty')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="text" name="price" class="form-control" id="price" value="{{ old('price') }}">
                                @error('price')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Future Image</label>
                                <input type="file" name="image" class="form-control" id="image" >
                                @error('image')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
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
                                        <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
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
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @empty
                                        <span class="text-danger">Sorry, Brand Not Found!</span>
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
                                    <option value="0">Pending</option>
                                    <option value="1">Published</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="text-end">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-sm btn-outline-primary">Create</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection