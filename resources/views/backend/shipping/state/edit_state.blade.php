@extends('admin.admin_master')
@section('admin')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                {{-- ----------- Edit State Page ------------- --}}
                <div class="col-6">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit State Details</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="post" action="{{ route('state.update', $state->id) }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $state->id }}">

                                    <div class="form-group">
                                        <h5>Division Select <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="division_id" class="form-control" aria-invalid="false">
                                                <option value="" selected="" disabled="">Select Division</option>
                                                @foreach ($divisions as $division)
                                                    <option value="{{ $division->id }}"
                                                        {{ $state->division_id == $division->id ? 'selected' : '' }}>
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
                                                @foreach ($districts as $district)
                                                    <option value="{{ $district->id }}"
                                                        {{ $state->district_id == $district->id ? 'selected' : '' }}>
                                                        {{ $district->district_name }}</option>
                                                @endforeach
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
                                            <input type="text" name="state_name" class="form-control"
                                                value="{{ $state->state_name }}" placeholder="">
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
