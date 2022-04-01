@extends('admin.admin_master')
@section('admin')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                {{-- ----------- Edit District Page ------------- --}}
                <div class="col-6">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit District</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="post" action="{{ route('district.update', $district->id) }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $district->id }}">

                                    <div class="form-group">
                                        <h5>Division Select <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="division_id" class="form-control" aria-invalid="false">
                                                <option value="" selected="" disabled="">Select Division</option>
                                                @foreach ($divisions as $division)
                                                    <option value="{{ $division->id }}"
                                                        {{ $district->division_id == $division->id ? 'selected' : '' }}>
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
                                            <input type="text" name="district_name" class="form-control"
                                                value="{{ $district->district_name }}" placeholder="">
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
