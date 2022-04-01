@extends('admin.admin_master')
@section('admin')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-8">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">State List</h3>
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
                                            <th>State</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($states as $item)
                                            <tr>
                                                <td>{{ $item->division->division_name }}</td>
                                                <td>{{ $item->district->district_name }}</td>
                                                <td>{{ $item->state_name }}</td>
                                                <td width="30%">
                                                    <a href="{{ route('state.edit', $item->id) }}" class="btn btn-info"
                                                        title="Edit Data"><i class="fas fa-pencil-alt"></i></a>
                                                    <a href="{{ route('state.delete', $item->id) }}"
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

                {{-- ----------- Add State Section ------------- --}}
                <div class="col-4">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add State</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="post" action="{{ route('state.store') }}">
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
                                        <h5>District <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="district_id" class="form-control" aria-invalid="false">
                                                <option value="" selected="" disabled="">Select District</option>
                                            </select>
                                            @error('division_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>State Name <span class="text-danger">*</span>
                                        </h5>
                                        <div class="controls">
                                            <input type="text" name="state_name" class="form-control">

                                            @error('state_name')
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

    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="division_id"]').on('change', function() {
                var division_id = $(this).val();
                if (division_id) {
                    $.ajax({
                        url: "{{ url('/shipping/district/ajax') }}/" + division_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            var d = $('select[name="district_id"]').empty();
                            if (data.length === 0) {
                                $('select[name="district_id"]').append(
                                    '<option value="" disabled selected>No District Available</option>'
                                );
                            } else {
                                $('select[name="district_id"]').append(
                                    '<option value="" disabled selected>Select District</option>'
                                );
                                $.each(data, function(key, value) {
                                    $('select[name="district_id"]').append(
                                        '<option value="' + value.id + '">' + value
                                        .district_name + '</option>');
                                });
                            }

                        },
                    });
                } else {
                    alert('danger');
                }
            })
        })
    </script>
@endsection
