@extends('layouts.backend.table-app')

@section('title', 'Settings')

@push('css')
@endpush

@section('content')
<div class="container-fluid">
<div class="row clearfix">

<div class="col-xs-12 col-sm-12">
<div class="card">
<div class="body">
<div>
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#profile_settings" aria-controls="settings" role="tab" data-toggle="tab" aria-expanded="true">Profile Settings</a></li>
        <li role="presentation" class=""><a href="#change_password_settings" aria-controls="settings" role="tab" data-toggle="tab" aria-expanded="false">Change Password</a></li>
    </ul>

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade active in" id="profile_settings">           
            <form class="form-horizontal" action="{{ route('admin.update.profile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Name:</label>
                    <div class="col-sm-10">
                        <div class="form-line focused">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name Surname" value="{{ Auth::user()->name }}" required="">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Email:</label>
                    <div class="col-sm-10">
                        <div class="form-line focused">
                            <input type="email" class="form-control" id="email" name="email" placeholder="email" value="{{ Auth::user()->email }}" required="">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="image" class="col-sm-2 control-label">Profile Image:</label>
                    <div class="col-sm-10">
                        <div class="form-line">
                            <input type="file" class="form-control" id="image" name="image" placeholder="upload image">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="body" class="col-sm-2 control-label">About:</label>
                    <div class="col-sm-10">
                        <div class="form-line">
                            <textarea class="form-control" id="body" name="about" rows="3" placeholder="description">{{ Auth::user()->about }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-danger">Update</button>
                    </div>
                </div>
            </form>
        </div>
        
        <div role="tabpanel" class="tab-pane fade" id="change_password_settings">
            <form class="form-horizontal" action="{{ route('admin.update.password') }}" method="POST">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="oldPassword" class="col-sm-3 control-label">Old Password</label>
                    <div class="col-sm-9">
                        <div class="form-line">
                            <input type="password" class="form-control" id="oldPassword" name="old_password" placeholder="Old Password" required="">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="NewPassword" class="col-sm-3 control-label">New Password</label>
                    <div class="col-sm-9">
                        <div class="form-line">
                            <input type="password" class="form-control" id="NewPassword" name="password" placeholder="New Password" required="">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="NewPasswordConfirm" class="col-sm-3 control-label"> Confirm Password</label>
                    <div class="col-sm-9">
                        <div class="form-line">
                            <input type="password" class="form-control" id="NewPasswordConfirm" name="password_confirmation" placeholder="New Password (Confirm)" required="">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" class="btn btn-danger">SUBMIT</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection

@push('js')    
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>

     <script type="text/javascript">
        function deleteAuthors(id) {
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