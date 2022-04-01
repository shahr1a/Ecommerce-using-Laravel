@extends('admin.admin_master')
@section('admin')

    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-8">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Brand List</h3>
                            <h6 class="box-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example"
                                    class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                    <thead>
                                        <tr>
                                            <th>Brand En</th>
                                            <th>Brand Bn</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($brands as $item)
                                            <tr>
                                                <td>{{ $item->brand_name_en }}</td>
                                                <td>{{ $item->brand_name_bn }}</td>
                                                <td><img src="{{ asset($item->brand_image_path) }}" alt=""
                                                        style="height: 40px; width: 70px;"></td>
                                                <td>
                                                    <a href="{{ route('brand.edit', $item->id) }}" class="btn btn-info"
                                                        title="Edit Data"><i class="fas fa-pencil-alt"></i></a>
                                                    <a href="{{ route('brand.delete', $item->id) }}"
                                                        class="btn btn-danger" id="delete" title="Delete Data"><i
                                                            class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->

                {{-- ----------- Add Brand Page ------------- --}}
                <div class="col-4">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Brand</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="post" action="{{ route('brand.store') }}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <h5>Brand Name English <span class="text-danger">*</span>
                                        </h5>
                                        <div class="controls">
                                            <input type="text" name="brand_name_en" class="form-control" placeholder="">

                                            @error('brand_name_en')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>Brand Name Bangla <span class="text-danger">*</span>
                                        </h5>
                                        <div class="controls">
                                            <input type="text" name="brand_name_bn" class="form-control" placeholder="">

                                            @error('brand_name_bn')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>Brand Image <span class="text-danger">*</span>
                                        </h5>
                                        <div class="controls">
                                            <input type="file" name="brand_image_path" class="form-control"
                                                placeholder="">
                                            @error('brand_image_path')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="text-xs-right">
                                        <input type="submit" value="Add New" class="btn btn-rounded btn-primary mb-5">
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
