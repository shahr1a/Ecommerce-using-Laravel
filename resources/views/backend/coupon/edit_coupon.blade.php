@extends('admin.admin_master')
@section('admin')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                {{-- ----------- Edit Coupon Page ------------- --}}
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Coupon</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="post" action="{{ route('coupon.update', $coupon->id) }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $coupon->id }}">

                                    <div class="form-group">
                                        <h5>Coupon Name <span class="text-danger">*</span>
                                        </h5>
                                        <div class="controls">
                                            <input type="text" name="coupon_name" class="form-control"
                                                value="{{ $coupon->coupon_name }}" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>Coupon Discount <span class="text-danger">*</span>
                                        </h5>
                                        <div class="controls">
                                            <input type="text" name="coupon_discount" class="form-control"
                                                value="{{ $coupon->coupon_discount }}" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>Coupon Validity <span class="text-danger">*</span>
                                        </h5>
                                        <div class="controls">
                                            <input type="date" name="coupon_validity" class="form-control"
                                                value="{{ Carbon\Carbon::parse($coupon->coupon_validity)->format('Y-m-d') }}"
                                                min="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
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
