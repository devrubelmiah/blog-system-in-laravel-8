@extends('layouts.backend.table-app')

@section('title', 'Edit Category')

@push('css')
@endpush

@section('content')
        <div class="container-fluid">
             <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2> Edit Category </h2>                           
                        </div>
                        <div class="body">
                        <form action="{{ route('admin.category.update', $category->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                            <div class="form-group">
                                <label for="name">Category Name:</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter category name" id="name" value="{{ $category->name }}">
                            </div>
                            
                            <div class="form-group">
                                <label for="image">Image:</label>
                                <input type="file" name="image" class="form-control" id="image">
                            </div>
                            <a  class="btn btn-danger" href="{{ route('admin.category.index') }}">BACK</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
@endsection

@push('js')    
@endpush