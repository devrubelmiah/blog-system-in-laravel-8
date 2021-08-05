@extends('layouts.backend.table-app')

@section('title', 'Favorite')

@push('css')
@endpush

@section('content')
         <div class="container-fluid">
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2> All Comments....... </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                       <tr>
                                            <th>ID</th>
                                            <th>Comment Info</th>
                                            <th>Post Info</th> 
                                            <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Comment Info</th>
                                                <th>Post Info</th> 
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>

                                    <tbody>
                                    @foreach($posts as $key => $post)
                                        
                                        @foreach( $post->comments as $key => $comment )
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                            <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                <img class="media-object" src="{{ Storage::disk('public')->url('profile/'.$comment->user->image) }}" alt="Profile Picture" width="65" height="65">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-heading">{{ $comment->user->name }} <small>on {{$comment->created_at->diffForHumans()}}  </small> </h4>
                                                <p> {{ $comment->comment }} </p>
                                                <a href="{{ route('post.detail',$comment->post->slug) }}" target="_blank"> Reply </a>
                                            </div>
                                            </div>                                            
                                            </td>
                                            <td>
                                            <div class="media">
                                            <div class="media-left">
                                                <a href="{{ route('post.detail',$comment->post->slug) }}" target="_blank" >
                                                <img class="media-object" src="{{ Storage::disk('public')->url('post/'.$comment->post->image) }}" alt="Profile Picture" width="65" height="65">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-heading">{{ $comment->post->user->name }} <small>on {{$comment->post->user->created_at->diffForHumans()}}  </small> </h4>
                                                <a href="{{ route('post.detail',$comment->post->slug) }}" target="_blank">
                                                <p> {{ Str::limit($comment->post->title, 40, '...') }} </p>
                                                  </a>
                                            </div>
                                            </div> 
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-danger waves-effect" type="button" onclick="deleteComment({{ $comment->id }})">
                                                    <i class="material-icons">delete</i>
                                                </button>
                                                <form id="delete-form-{{ $comment->id }}" action="{{ route('author.destroy.comment',$comment->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
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
        function deleteComment(id) {
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