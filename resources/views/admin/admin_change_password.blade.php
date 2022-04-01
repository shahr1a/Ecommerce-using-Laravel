@extends('admin.admin_master')
@section('admin')

    <div class="container-full">
        <!-- Main content -->
        <section class="content">

            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Admin Change Password</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form method="post" action="{{ route('update.change.password') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Current Password <span class="text-danger">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <input type="password" id="current_password" name="oldpassword"
                                                            class="form-control" required=""
                                                            placeholder="Enter Current Password">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <h5>New Password <span class="text-danger">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <input type="password" id="password" name="password"
                                                            class="form-control" placeholder="Type New Password Here">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <h5>New Password <span class="text-danger">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <input type="password" id="password_confirmation"
                                                            name="password_confirmation" class="form-control"
                                                            placeholder="Confirm Password">
                                                    </div>
                                                </div>
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

@endsection
