@extends('layouts.backend')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Brands</h1>
        <a href="{{ route('brand.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Show Brands</a>
    </div>

    <div class="card shadow">
        {{-- Alert --}}
        @include('dashboard.include.alert')
        <div class="card-body">
            <form action="{{ route('brand.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="brand_name" class="form-label">Brand Name</label>
                    <input type="text" name="brand_name" class="form-control" id="brand_name" value="{{ old('brand_name') }}">
                    @error('brand_name')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <select name="status" class="form-select">
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
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
@endsection