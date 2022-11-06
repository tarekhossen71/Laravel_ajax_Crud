@extends('layouts.backend')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Categories List</h1>
        <a href="{{ route('category.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Add Category</a>
    </div>

    <div class="card shadow">
        <table class="table table-stripted-table-hover table-bordered">
            <thead>
                <th>Sl</th>
                <th>Categories Name</th>
                <th>Status</th>
                <th>Action</th>
            </thead>
            <tbody>
                @forelse ($categories as $key => $item)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $item->category_name }}</td>
                        <td>
                            @if ($item->status == 1)
                                <span class="badge bg-success">Published</span>
                            @else
                                <span class="badge bg-danger">Pending</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <a href="{{ route('category.edit', $item->id) }}" class="btn btn-sm btn-info me-1">Edit</a>
                                <form id="delete-form-{{ $item->id }}" action="{{ route('category.destroy',$item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button onclick="alertMessage({{ $item->id }})" type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </div>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-danger text-center"><span >Sorry, No Data Found!</span></td>
                        </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection