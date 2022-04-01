@extends('admin.admin_master')
@section('admin')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"
        integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <div class="container-full">
        <!-- Main content -->
        <section class="content">

            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Admin Profile Edit</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form method="post" action="{{ route('admin.profile.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Admin Username <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="name" class="form-control" required=""
                                                            value="{{ $adminData->name }}">
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 6 -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Admin Email <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="email" name="email" class="form-control" required=""
                                                            value="{{ $adminData->email }}">
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 6 -->
                                        </div> <!-- end row -->
                                        <div class="form-group">
                                            <h5>Current Password <span class="text-danger">*</span>
                                            </h5>
                                            <div class="controls">
                                                <input type="password" name="password" class="form-control" required=""
                                                    value="{{ $adminData->password }}" disabled>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>New Password <span class="text-danger">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <input type="password" name="new_password" class="form-control"
                                                            placeholder="New Password">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Repeat Password <span class="text-danger">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <input type="password" name="new_confirmPassword"
                                                            data-validation-match-match="new_password"
                                                            class="form-control" placeholder="Repeat New Password">
                                                        <div class="help-block"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Profile Image <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="file" name="profile_photo_path" class="form-control"
                                                            id="image">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <img id="showImage"
                                                    src="{{ !empty($adminData->profile_photo_path) ? url('upload/admin_images/' . $adminData->profile_photo_path) : url('upload/default.png') }}"
                                                    style="width: 200px; height: 150px;" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-xs-right">
                                    <input type="submit" value="Update" class="btn btn-rounded btn-primary mb-5">
                                </div>
                            </form>

                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

@endsection
