@extends('admin.admin_master')
@section('admin')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                {{-- ----------- Edit Division Page ------------- --}}
                <div class="col-6">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Division</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="post" action="{{ route('division.update', $division->id) }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $division->id }}">

                                    <div class="form-group">
                                        <h5>Division Name <span class="text-danger">*</span>
                                        </h5>
                                        <div class="controls">
                                            <input type="text" name="division_name" class="form-control"
                                                value="{{ $division->division_name }}" placeholder="">
                                        </div>
                                    </div>
                                    <div class="text-xs-right">
                                        <input type="submit" value="Update" class="btn btn-rounded btn-primary mb-5">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
