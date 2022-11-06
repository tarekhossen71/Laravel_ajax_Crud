@extends('layouts.backend')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Category Edit</h1>
        <a href="{{ route('category.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Show Categories</a>
    </div>

    <div class="card shadow">
        {{-- Alert --}}
        @include('dashboard.include.alert')
        <div class="card-body">
            <form action="{{ route('category.update',$category->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="category_name" class="form-label">Category Name</label>
                    <input type="text" name="category_name" class="form-control" id="category_name" value="{{ $category->category_name }}">
                    @error('category_name')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <select name="status" class="form-select">
                        <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Pending</option>
                        <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Published</option>
                    </select>
                    @error('status')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection