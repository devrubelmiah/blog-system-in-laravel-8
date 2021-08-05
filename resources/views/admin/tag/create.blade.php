@extends('layouts.backend.table-app')

@section('title', 'Tag')

@push('css')
@endpush

@section('content')
        <div class="container-fluid">
             <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Add New Tag
                            </h2>                           
                        </div>
                        <div class="body">

                        <form action="{{ route('admin.tag.store') }}" method="post">
                        @csrf
                            <div class="form-group">
                                <label for="name">Tag Name:</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter tag name" id="name">
                            </div>
                            <a  class="btn btn-danger" href="{{ route('admin.tag.index') }}">BACK</a>
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