@extends('frontend.main_master')
@section('content')
@section('title')
    Checkout
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="home.html">Home</a></li>
                <li class='active'>Checkout</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="checkout-box ">
            <div class="row">
                <div class="col-md-8">
                    <div class="panel-group checkout-steps" id="accordion">
                        <!-- checkout-step-01  -->
                        <div class="panel panel-default checkout-step-01">

                            <!-- panel-heading -->
                            <div class="panel-heading">
                                <h4 class="unicase-checkout-title">
                                    <a data-toggle="collapse" class="" data-parent="#accordion"
                                        href="#collapseOne">
                                        <span>1</span>Checkout Method
                                    </a>
                                </h4>
                            </div>
                            <!-- panel-heading -->

                            <div id="collapseOne" class="panel-collapse collapse in">

                                <!-- panel-body  -->
                                <div class="panel-body">
                                    <div class="row">

                                        <!-- guest-login -->
                                        <div class="col-md-6 col-sm-6 guest-login">
                                            <h4 class="checkout-subtitle"><b>Shipping Details</b></h4>
                                            <form class="register-form" action="{{ route('checkout.store') }}"
                                                method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1"><b>Customer
                                                            Name</b>
                                                        <span>*</span></label>
                                                    <input type="text"
                                                        class="form-control unicase-form-control text-input"
                                                        name="customer_name" id="exampleInputEmail1"
                                                        placeholder="Full Name" value="{{ Auth::user()->name }}"
                                                        required="">
                                                </div>
                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1">Customer
                                                        <b>Email</b>
                                                        <span>*</span></label>
                                                    <input type="email"
                                                        class="form-control unicase-form-control text-input"
                                                        name="customer_email" id="exampleInputEmail1"
                                                        placeholder="Email" value="{{ Auth::user()->email }}"
                                                        required="">
                                                </div>
                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1">
                                                        <b>Customer Phone Number</b>
                                                        <span>*</span></label>
                                                    <input type="text"
                                                        class="form-control unicase-form-control text-input"
                                                        name="customer_phone" id="exampleInputEmail1"
                                                        placeholder="Phone Number"
                                                        value="{{ Auth::user()->phone_number }}" required="">
                                                </div>
                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1">
                                                        <b>Postal Code</b>
                                                        <span>*</span></label>
                                                    <input type="text"
                                                        class="form-control unicase-form-control text-input"
                                                        name="post_code" id="exampleInputEmail1"
                                                        placeholder="Postal Code" required="">
                                                </div>
                                        </div>
                                        <!-- guest-login -->

                                        <!-- already-registered-login -->
                                        <div class="col-md-6 col-sm-6 already-registered-login">
                                            <div class="form-group">
                                                <h5><b>Division</b> <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="division_id" class="form-control"
                                                        aria-invalid="false">
                                                        <option value="" selected="" disabled="">Select Division
                                                        </option>
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
                                                <h5><b>District</b> <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="district_id" class="form-control"
                                                        aria-invalid="false">
                                                        <option value="" selected="" disabled="">Select District
                                                        </option>
                                                    </select>
                                                    @error('division_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <h5><b>State Name</b> <span class="text-danger">*</span>
                                                </h5>
                                                <div class="controls">
                                                    <select name="state_id" class="form-control" aria-invalid="false">
                                                        <option value="" selected="" disabled="">Select State
                                                        </option>
                                                    </select>

                                                    @error('state_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="info-title" for="exampleInputEmail1">
                                                    Notes
                                                    <span>*</span></label>
                                                <textarea class="form-control" cols="30" rows="5" name="notes"
                                                    id="exampleInputEmail1" placeholder="Notes"></textarea>

                                            </div>

                                        </div>
                                        <!-- already-registered-login -->

                                    </div>
                                </div>
                                <!-- panel-body  -->

                            </div><!-- row -->
                        </div>
                        <!-- checkout-step-01  -->
                    </div><!-- /.checkout-steps -->
                </div>
                <div class="col-md-4">
                    <!-- checkout-progress-sidebar -->
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Your Checkout Progress</h4>
                                </div>
                                <div class="">
                                    <ul class="nav nav-checkout-progress list-unstyled">

                                        @foreach ($carts as $item)
                                            <li>
                                                <strong>{{ $item->name }} </strong>
                                            </li>
                                            <li>
                                                <strong>Image: </strong>
                                                <img src="{{ asset($item->options->image) }}" alt=""
                                                    style="height: 50px; width:50px">
                                            </li>
                                            <li>
                                                <strong>Quantity: (</strong>{{ $item->qty }})
                                                <strong>Color: </strong>{{ $item->options->color }}
                                                <strong>Size: </strong>{{ $item->options->size }}

                                            </li>
                                            <br>
                                        @endforeach
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
                <div class="col-md-4">
                    <!-- checkout-progress-sidebar -->
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Select Payment Method</h4>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">Stripe</label>
                                        <input type="radio" name="payment_method" id="" value="stripe">
                                        <img src="{{ asset('frontend/assets/images/payments/4.png') }}" alt="">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Card</label>
                                        <input type="radio" name="payment_method" id="" value="card">
                                        <img src="{{ asset('frontend/assets/images/payments/3.png') }}" alt="">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Cash</label>
                                        <input type="radio" name="payment_method" id="" value="cash">
                                        <img src="{{ asset('frontend/assets/images/payments/cash-on-delivery.png') }}"
                                            alt="" height="35px" width="45px">
                                    </div>
                                </div>
                                <hr>
                                <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Payment
                                    Step</button>
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



<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="division_id"]').on('change', function() {
            var division_id = $(this).val();
            if (division_id) {
                $.ajax({
                    url: "{{ url('/checkout/district/ajax') }}/" + division_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="state_id"]').empty();
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


    $(document).ready(function() {
        $('select[name="district_id"]').on('change', function() {
            var district_id = $(this).val();
            if (district_id) {
                $.ajax({
                    url: "{{ url('/checkout/state/ajax') }}/" + district_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var d = $('select[name="state_id"]').empty();
                        if (data.length === 0) {
                            $('select[name="state_id"]').append(
                                '<option value="" disabled selected>No State Available</option>'
                            );
                        } else {
                            $('select[name="state_id"]').append(
                                '<option value="" disabled selected>Select State</option>'
                            );
                            $.each(data, function(key, value) {
                                $('select[name="state_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                    .state_name + '</option>');
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
