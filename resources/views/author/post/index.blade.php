@extends('layouts.backend.table-app')

@section('title', 'Post')

@push('css')
@endpush

@section('content')
         <div class="container-fluid">
            <div class="block-header">
                <h2>  <a class="btn btn-primary waves-effect" href="{{ route('author.post.create') }}">
                <i class="material-icons">add</i>
                <span>Add New Post</span>
            </a> </h2>
            </div>

            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>All Posts.......</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <td>Author</td>
                                            <th><i class="material-icons">visibility</i></th>
                                            <th>Is Approved</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <td>Author</td>
                                            <th><i class="material-icons">visibility</i></th>
                                            <th>Is Approved</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($posts as $key => $post)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td> {{ Str::limit($post->title, 15, '(...)') }} </td>
                                            <td> {{ $post->user->name }} </td>
                                            <td> {{ $post->view_count }} </td>
                                            <td> 
                                            @if($post->is_approved == true)
                                                <span class="badge bg-blue">Approved</span>
                                                @else
                                                <span class="badge bg-pink">unapproved</span>
                                            @endif
                                            </td>
                                            <td>
                                                  @if($post->status == true)
                                                <span class="badge bg-green">Published</span>
                                                @else
                                                <span class="badge bg-red">unpublished</span>
                                            @endif
                                            </td>
                                            <td> {{ date('d-m-Y', strtotime($post->created_at)) }} </td>
                                            <td> {{ date('d-m-Y', strtotime($post->updated_at)) }} </td>
                                             <td class="text-center">
                                             <a href="{{ route('author.post.show',$post->id) }}" class="btn btn-success waves-effect">
                                                <i class="material-icons">visibility</i>
                                            </a>
                                                <a href="{{ route('author.post.edit',$post->id) }}" class="btn btn-info waves-effect">
                                                    <i class="material-icons">edit</i>
                                                </a>
                                                <button class="btn btn-danger waves-effect" type="button" onclick="deleteCategory({{ $post->id }})">
                                                    <i class="material-icons">delete</i>
                                                </button>
                                                <form id="delete-form-{{ $post->id }}" action="{{ route('author.post.destroy',$post->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
@endsection

@push('js')    
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>

     <script type="text/javascript">
        function deleteCategory(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>
@endpush