@extends('layouts.backend')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Products List</h1>
        <a href="{{ route('product.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Add Products</a>
    </div>

    <div class="card shadow">
        <table class="table table-stripted-table-hover table-bordered">
            <thead>
                <th>Sl</th>
                <th>Brand</th>
                <th>Category</th>
                <th>Product Name</th>
                <th>Product Code</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Feature Image</th>
                <th>Action</th>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection