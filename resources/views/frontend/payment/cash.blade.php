@extends('frontend.main_master')
@section('content')
@section('title')
    Cash on Delivery
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>




<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="home.html">Home</a></li>
                <li class='active'>Cash on Delivery</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="checkout-box ">
            <div class="row">
                <div class="col-md-6">
                    <!-- checkout-progress-sidebar -->
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Amount to be Paid</h4>
                                </div>
                                <div class="">
                                    <ul class="nav nav-checkout-progress list-unstyled">
                                        <hr>
                                        <li>
                                            @if (Session::has('coupon'))
                                                <strong>Subtotal: </strong> ${{ $cartTotal }}
                                                <hr>
                                                <strong>Coupon Name: </strong>
                                                {{ session()->get('coupon')['coupon_name'] }}
                                                ({{ session()->get('coupon')['coupon_discount'] }}%)
                                                <hr>
                                                <strong>Coupon Discount: </strong>
                                                (${{ session()->get('coupon')['discount_amount'] }})
                                                <hr>
                                                <strong>Grand Total: </strong>
                                                (${{ session()->get('coupon')['total_amount'] }})
                                                <hr>
                                            @else
                                                <strong>Subtotal: </strong> ${{ $cartTotal }}
                                                <hr>
                                                <strong>Grand Total: </strong> ${{ $cartTotal }}
                                                <hr>
                                            @endif

                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- checkout-progress-sidebar -->
                </div>
                <div class="col-md-6">
                    <!-- checkout-progress-sidebar -->
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Select Payment Method</h4>
                                </div>
                                <form action="{{ route('cash.order') }}" method="post" id="payment-form">
                                    @csrf
                                    <div class="form-row">
                                        <img src="{{ asset('frontend/assets/images/payments/cash.png') }}" alt="">
                                        <label for="card-element">
                                            <input type="hidden" name="name" id=""
                                                value="{{ $data['customer_name'] }}">
                                            <input type="hidden" name="email" id=""
                                                value="{{ $data['customer_email'] }}">
                                            <input type="hidden" name="phone" id=""
                                                value="{{ $data['customer_phone'] }}">
                                            <input type="hidden" name="post_code" id=""
                                                value="{{ $data['post_code'] }}">
                                            <input type="hidden" name="division_id" id=""
                                                value="{{ $data['division_id'] }}">
                                            <input type="hidden" name="district_id" id=""
                                                value="{{ $data['district_id'] }}">
                                            <input type="hidden" name="state_id" id=""
                                                value="{{ $data['state_id'] }}">
                                            <input type="hidden" name="notes" id="" value="{{ $data['notes'] }}">
                                        </label>
                                    </div>
                                    <br>
                                    <button class="btn btn-primary">Confirm Order</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- checkout-progress-sidebar -->
                </div>
                </form>
            </div><!-- /.row -->
        </div><!-- /.checkout-box -->
    </div><!-- /.container -->
</div><!-- /.body-content -->

@endsection
