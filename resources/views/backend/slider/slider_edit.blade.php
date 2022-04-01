@extends('admin.admin_master')
@section('admin')

    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                {{-- ----------- Edit Slider Page ------------- --}}
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Slider</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="post" action="{{ route('slider.update', $slider->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $slider->id }}">
                                    <input type="hidden" name="old_image" value="{{ $slider->slider_img }}">

                                    <div class="form-group">
                                        <h5>Slider Title <span class="text-danger">*</span>
                                        </h5>
                                        <div class="controls">
                                            <input type="text" name="title" class="form-control"
                                                value="{{ $slider->title }}" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>Description <span class="text-danger">*</span>
                                        </h5>
                                        <div class="controls">
                                            <input type="text" name="description" class="form-control"
                                                value="{{ $slider->description }}" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>Slider Image <span class="text-danger">*</span>
                                        </h5>
                                        <div class="controls">
                                            <input type="file" name="slider_img" class="form-control" placeholder="">
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
