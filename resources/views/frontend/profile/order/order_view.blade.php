@extends('frontend.main_master')
@section('content')
    <div class="body-content">
        <div class="container">
            <div class="row">
                @include('frontend.profile.body.user_profile_sidebar')
                <div class="col-md-10">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr style="background: #e2e2e2">
                                    <td class="col-md-3">
                                        <label for="">Date</label>
                                    </td>
                                    <td class="col-md-1">
                                        <label for="">Total</label>
                                    </td>
                                    <td class="col-md-1">
                                        <label for="">Payment</label>
                                    </td>
                                    <td class="col-md-2">
                                        <label for="">Invoice</label>
                                    </td>
                                    <td class="col-md-2">
                                        <label for="">Order</label>
                                    </td>
                                    <td class="col-md-5">
                                        <label for="">Action</label>
                                    </td>
                                </tr>

                                @foreach ($orders as $order)
                                    <tr>
                                        <td>
                                            <label for="">{{ $order->order_date }}</label>
                                        </td>
                                        <td>
                                            <label for="">${{ $order->amount }}</label>
                                        </td>
                                        <td>
                                            <label for="">{{ $order->payment_type }}</label>
                                        </td>
                                        <td>
                                            <label for="">{{ $order->invoice_no }}</label>
                                        </td>
                                        <td>
                                            <label for=""><span class="badge badge-pill badge-warning"
                                                    style="background: #418DB9">{{ $order->status }}</span></label>
                                        </td>
                                        <td>
                                            <a href="{{ url('user/order-details/' . $order->id) }}"
                                                class="btn btn-sm btn-primary">
                                                <i class="fa fa-eye"></i> View
                                            </a>
                                            <a target="_blank" href="{{ url('user/invoice_download/' . $order->id) }}"
                                                class="btn btn-sm btn-danger" style="margin-top: 5px">
                                                <i class="fa fa-download" style="color: white"></i> Invoice
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
