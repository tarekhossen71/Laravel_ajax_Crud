@extends('layouts.backend')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Products List</h1>
        <a href="{{ route('product.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Add Products</a>
    </div>

    <div class="card shadow">
         {{-- Alert --}}
         @include('dashboard.include.alert')
        <table class="table table-stripted-table-hover table-bordered">
            <thead>
                <th>Sl</th>
                <th>Brand</th>
                <th>Category</th>
                <th>Product Name</th>
                <th>Product Slug</th>
                <th>Product Code</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Feature Image</th>
                <th>Status</th>
                <th>Action</th>
            </thead>
            <tbody>
                @if ($products->count() > 0)
                    @forelse ($products as $key=>$product)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $product->brand->brand_name }}</td>
                            <td>{{ $product->category->category_name }}</td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->product_slug }}</td>
                            <td>{{ $product->product_code }}</td>
                            <td>{{ $product->qty }}</td>
                            <td>{{ $product->price }}</td>
                            <td>
                                <img width="50" height="50" src="{{ $product->image != null ? asset('products/images/'.$product->image) : 'https://via.placeholder.com/50' }}" alt="">
                            </td>
                            <td>
                                @if ($product->status == 1)
                                    <span class="badge bg-success">Published</span>
                                @else
                                    <span class="badge bg-danger">Pending</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('product.show', $product->id) }}" class="btn btn-sm btn-primary me-2">View</a>
                                    <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-info me-2">Edit</a>
                                    <form id="delete-form-{{ $product->id }}" action="{{ route('product.destroy',$product->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button onclick="alertMessage({{ $product->id }})" type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        
                    @endforelse
                @endif
                
            </tbody>
        </table>
    </div>
@endsection