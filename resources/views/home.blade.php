@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <form action="{{ route('file.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="d-flex">
                            <input type="file" name="avater" class="form-control">
                            <input type="submit" value="Upload" class="btn btn-sm btn-primary ms-2">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
