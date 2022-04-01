@extends('admin.admin_master')
@section('admin')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-8">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Coupon List</h3>
                            <h6 class="box-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example"
                                    class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                    <thead>
                                        <tr>
                                            <th>Coupon Name</th>
                                            <th>Coupon Discount</th>
                                            <th>Coupon Validity</th>
                                            <th>Coupon Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($coupons as $item)
                                            <tr>
                                                <td>{{ $item->coupon_name }}</td>
                                                <td>{{ $item->coupon_discount }}%</td>
                                                <td>
                                                    {{ Carbon\Carbon::parse($item->coupon_validity)->format('D, d F Y') }}
                                                </td>
                                                <td>
                                                    @if ($item->status != true || $item->coupon_validity <= Carbon\Carbon::now()->format('Y-m-d'))
                                                        <span class="badge badge-pill badge-danger">Invalid</span>
                                                    @else
                                                        <span class="badge badge-pill badge-success">Valid</span>
                                                    @endif
                                                </td>
                                                <td width="30%">
                                                    <a href="{{ route('coupon.edit', $item->id) }}" class="btn btn-info"
                                                        title="Edit Data"><i class="fas fa-pencil-alt"></i></a>
                                                    <a href="{{ route('coupon.delete', $item->id) }}"
                                                        class="btn btn-danger" id="delete" title="Delete Data"><i
                                                            class="fa fa-trash"></i></a>

                                                    @if ($item->status != true || $item->coupon_validity <= Carbon\Carbon::now()->format('Y-m-d'))
                                                        <a href="{{ route('coupon.active', $item->id) }}"
                                                            class="btn btn-success" title="Active Now"><i
                                                                class="fa fa-arrow-up"></i></a>
                                                    @else
                                                        <a href="{{ route('coupon.inactive', $item->id) }}"
                                                            class="btn btn-danger" title="Deactivate Now"><i
                                                                class="fa fa-arrow-down"></i></a>
                                                    @endif
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

                {{-- ----------- Add Coupon Section ------------- --}}
                <div class="col-4">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Coupon</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="post" action="{{ route('coupon.store') }}">
                                    @csrf

                                    <div class="form-group">
                                        <h5>Coupon Name <span class="text-danger">*</span>
                                        </h5>
                                        <div class="controls">
                                            <input type="text" name="coupon_name" class="form-control">

                                            @error('coupon_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Coupon Discount(%) <span class="text-danger">*</span>
                                        </h5>
                                        <div class="controls">
                                            <input type="text" name="coupon_discount" class="form-control" placeholder="">

                                            @error('coupon_discount')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Coupon Validity <span class="text-danger">*</span>
                                        </h5>
                                        <div class="controls">
                                            <input type="date" name="coupon_validity" class="form-control" placeholder=""
                                                min="{{ Carbon\Carbon::now()->format('Y-m-d') }}">

                                            @error('coupon_validity')
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
