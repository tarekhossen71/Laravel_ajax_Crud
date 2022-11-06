@extends('layouts.backend')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Products</h1>
        <a href="{{ route('product.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Show Products</a>
    </div>

    <div class="card shadow">
        
    </div>
@endsection