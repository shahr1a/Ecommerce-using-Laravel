@extends('admin.admin_master')
@section('admin')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-8">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">District List</h3>
                            <h6 class="box-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example"
                                    class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                    <thead>
                                        <tr>
                                            <th>Division</th>
                                            <th>District</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($districts as $item)
                                            <tr>
                                                <td>{{ $item->division->division_name }}</td>
                                                <td>{{ $item->district_name }}</td>
                                                <td width="30%">
                                                    <a href="{{ route('district.edit', $item->id) }}"
                                                        class="btn btn-info" title="Edit Data"><i
                                                            class="fas fa-pencil-alt"></i></a>
                                                    <a href="{{ route('district.delete', $item->id) }}"
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

                {{-- ----------- Add District Section ------------- --}}
                <div class="col-4">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add District</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="post" action="{{ route('district.store') }}">
                                    @csrf

                                    <div class="form-group">
                                        <h5>Division <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="division_id" class="form-control" aria-invalid="false">
                                                <option value="" selected="" disabled="">Select Division</option>
                                                @foreach ($divisions as $division)
                                                    <option value="{{ $division->id }}">
                                                        {{ $division->division_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('division_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>District Name <span class="text-danger">*</span>
                                        </h5>
                                        <div class="controls">
                                            <input type="text" name="district_name" class="form-control">

                                            @error('district_name')
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
