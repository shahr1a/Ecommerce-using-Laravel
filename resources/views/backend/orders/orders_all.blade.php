@extends('admin.admin_master')
@section('admin')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">All Order List</h3>
                            <h6 class="box-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example"
                                    class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Invoice</th>
                                            <th>Amount</th>
                                            <th>Payment</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $item)
                                            <tr>
                                                <td>
                                                    {{ Carbon\Carbon::parse($item->order_date)->format('D, d F Y') }}
                                                </td>
                                                <td>{{ $item->invoice_no }}</td>
                                                <td>${{ $item->amount }}</td>
                                                <td>{{ $item->payment_type }}</td>
                                                <td>
                                                    @if($item->status == 'Pending')
                                                    <span class="badge badge-pill badge-info">{{ $item->status }}</span>
                                                    @elseif($item->status == 'Confirmed')
                                                    <span class="badge badge-pill badge-success">{{ $item->status }}</span>
                                                    @elseif($item->status == 'Processing')
                                                    <span class="badge badge-pill badge-warning" style="background: #5E29BE;">{{ $item->status }}</span>
                                                    @elseif($item->status == 'Picked')
                                                    <span class="badge badge-pill badge-success" style="background: #7591DD;">{{ $item->status }}</span>
                                                    @elseif($item->status == 'Shipped')
                                                    <span class="badge badge-pill badge-success" style="background: #BADD75;">{{ $item->status }}</span>
                                                    @elseif($item->status == 'Delivered')
                                                    <span class="badge badge-pill badge-success" style="background: #B129BE;">{{ $item->status }}</span>
                                                    @endif
                                                    
                                                </td>
                                                <td width="30%">
                                                    <a href="{{ route('order.details', $item->id) }}"
                                                        class="btn btn-info" title="View Data"><i
                                                            class="fas fa-eye"></i></a>
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
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
