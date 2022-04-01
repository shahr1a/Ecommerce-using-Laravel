@extends('frontend.main_master')
@section('content')
@section('title')
    My Cart Page
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="home.html">Home</a></li>
                <li class='active'>My Cart</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content outer-top-xs">
    <div class="container">
        <div class="row">
            <div class="shopping-cart">
                <div class="shopping-cart-table ">
                    <div class="table-responsive">
                        <table class="table" id="cartPage">
                        </table>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12 estimate-ship-tax">
                </div>

                <div class="col-md-4 col-sm-12 estimate-ship-tax">
                    @if (Session::has('coupon'))
                    @else
                        <table class="table" id="couponField">
                            <thead>
                                <tr>
                                    <th>
                                        <span class="estimate-title">Discount Code</span>
                                        <p>Enter your coupon code if you have one..</p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control unicase-form-control text-input"
                                                placeholder="You Coupon.." id="coupon_name">
                                        </div>
                                        <div class="clearfix pull-right">
                                            <button type="submit" class="btn-upper btn btn-primary"
                                                onclick="applyCoupon()">APPLY COUPON</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody><!-- /tbody -->
                        </table><!-- /table -->
                    @endif
                </div><!-- /.estimate-ship-tax -->

                <div class="col-md-4 col-sm-12 cart-shopping-total">
                    <table class="table">
                        <thead id="couponCalField">

                        </thead><!-- /thead -->
                        <tbody>
                            <tr>
                                <td>
                                    <div class="cart-checkout-btn pull-right">
                                        <a href="{{ route('checkout') }}" type="submit"
                                            class="btn btn-primary checkout-btn">PROCCED TO
                                            CHEKOUT</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody><!-- /tbody -->
                    </table><!-- /table -->
                </div><!-- /.cart-shopping-total -->
            </div><!-- /.row -->
        </div><!-- /.sigin-in-->
        <br>
        @include('frontend.body.brands')
    </div>

</div>

<script type="text/javascript">
    function cart() {
        $.ajax({
            type: 'GET',
            url: '/user/get-cart-product',
            dataType: 'json',
            success: function(response) {
                var rows = ""
                var body = ""
                if (response.carts.length == 0) {
                    rows += `<div class="alert alert-info" role="alert">
                        <h4 class="alert-heading">Empty Cart</h4>                    
                        <hr>
                        <p>Browse for product and Add to your Cart</p>
                    </div>`

                    $('#cartPage').html(rows);
                } else {
                    rows += `<thead>
                                <tr>
                                    <th class="cart-romove item">Remove</th>
                                    <th class="cart-description item">Image</th>
                                    <th class="cart-product-name item">Product Name</th>
                                    <th class="cart-edit item">Edit</th>
                                    <th class="cart-qty item">Quantity</th>
                                    <th class="cart-sub-total item">Price</th>
                                    <th class="cart-total last-item">Sub Total</th>
                                </tr>
                            </thead>
        
                            <tfoot>
                                <tr>
                                    <td colspan="7">
                                        <div class="shopping-cart-btn">
                                            <span class="">
                                                <a href="#" class="btn btn-upper btn-primary outer-left-xs">Continue Shopping</a>
                                                <a href="#" class="btn btn-upper btn-primary pull-right outer-right-xs">Update shopping cart</a>
                                            </span>
                                        </div>
                                </tr>
                            </tfoot>
                            
                            <tbody id="tb">
                            
                            </tbody>
                            `
                    $('#cartPage').html(rows);
                    $.each(response.carts, function(key, value) {
                        body += `
                                    <tr>
                                        <td class="romove-item"><button type="submit" title="REMOVE" class="btn btn-danger btn-rounded" id="${value.rowId}" onclick="cartRemove(this.id)"><i class="fa fa-trash-o"></i></button></td>
                                        <td class="cart-image">
                                            <a class="entry-thumbnail" href="/product/details/${value.id}/${value.name}">
                                                <img src="/${value.options.image}" alt="" style="padding: 4rem;">
                                            </a>
                                        </td>
                                        <td class="cart-product-name-info">
                                            <h4 class='cart-product-description'><a href="/product/details/${value.id}/${value.name}"><strong style="color: #2F497E;">${value.name}</strong></a></h4>
                                            
                                            
                                            <div class="cart-product-info">
                                                ${value.options.size == null ? `<span class="product-color">SIZE:<span style="text-transform: uppercase;"><strong style="color: #9F2D7F">N/A</strong></span></span>` : `<span class="product-color">SIZE:<span style="text-transform: uppercase;"><strong style="color: #9F2D7F">${value.options.size}</strong></span></span>`}
                                                
                                            </div>
                                            
                                            <div class="cart-product-info">
                                                <span class="product-color">COLOR:<span style="text-transform: uppercase;"><strong>${value.options.color}</strong></span></span>
                                            </div>
                                        </td>
                                        <td class="cart-product-edit"><a href="#" class="product-edit">Edit</a></td>
                                        <td class="cart-product-quantity">

                                            ${value.qty > 1 ? 
                                                `<button type="submit" class="btn btn-danger btn-sm" id="${value.rowId}" onclick="cartDecrement(this.id)">-</button>`
                                                :
                                                `<button type="submit" class="btn btn-danger btn-sm" id="${value.rowId}" onclick="cartDecrement(this.id)" disabled="">-</button>`
                                            }
                                                        <input type="text" value="${value.qty}" min="1" max="100" disabled="" style="width:25px;" >
                                                        <button type="submit" class="btn btn-success btn-sm" id="${value.rowId}" onclick="cartIncrement(this.id)">+</button>

                                        </td>
                                        <td class="cart-product-sub-total"><span class="cart-sub-total-price"><strong>${value.price}</strong></span></td>
                                        <td class="cart-product-grand-total"><span class="cart-grand-total-price"><strong>${value.subtotal}</strong></span></td>
                                    </tr>
                                `
                        $('#tb').html(body);
                    });
                }
            }
        })
    }

    cart()

    function cartRemove(id) {
        $.ajax({
            type: 'GET',
            url: '/user/cart-product-remove/' + id,
            dataType: 'json',
            success: function(data) {
                cart()
                miniCart()
                couponCalculation()

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',

                    showConfirmButton: false,
                    timer: 3000
                })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',

                        title: data.success
                    })
                } else {
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error
                    })
                }
            }
        })
    }


    function cartIncrement(rowId) {
        $.ajax({
            type: 'GET',
            url: "/user/cart-increment/" + rowId,
            dataType: 'json',
            success: function(data) {
                cart()
                miniCart()
                couponCalculation()
            }
        })
    }

    function cartDecrement(rowId) {
        $.ajax({
            type: 'GET',
            url: "/user/cart-decrement/" + rowId,
            dataType: 'json',
            success: function(data) {
                cart()
                miniCart()
                couponCalculation()
            }
        })
    }
</script>

<script type="text/javascript">
    function applyCoupon() {

        var coupon_name = $('#coupon_name').val()

        $.ajax({
            type: "POST",
            data: {
                coupon_name: coupon_name
            },
            url: "{{ url('/coupon-apply') }}",
            dataType: 'json',
            success: function(data) {
                couponCalculation()

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',

                    showConfirmButton: false,
                    timer: 3000
                })
                if ($.isEmptyObject(data.error)) {
                    $('#couponField').hide()
                    Toast.fire({
                        type: 'success',
                        icon: 'success',

                        title: data.success
                    })
                } else {
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error
                    })
                }
            }
        })
    }

    function couponCalculation() {
        $.ajax({
            type: 'GET',
            url: "{{ url('/coupon-calculation') }}",
            dataType: 'json',
            success: function(data) {
                if (data.total) {
                    $('#couponField').show()
                    $('#coupon_name').val('')
                    $('#couponCalField').html(`
                        <tr>
                            <th>
                                <div class="cart-sub-total">
                                    Subtotal<span class="inner-left-md">$ ${data.total}</span>
                                </div>
                                <div class="cart-grand-total">
                                    Grand Total<span class="inner-left-md">$ ${data.total}</span>
                                </div>
                            </th>
                        </tr>
                    `)
                } else {
                    $('#couponCalField').html(`
                        <tr>
                            <th>
                                
                                <div class="cart-sub-total" style="display: flex; justify-content: space-between">
                                    Subtotal<span class="inner-left-md">$ ${data.subtotal}</span>
                                </div>

                                <div class="cart-sub-total" style="display: flex; justify-content: space-between">
                                    <div>
                                        Coupon
                                    </div>
                                    <div>
                                        ${data.coupon_name}
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="couponRemove()"><i class="fa fa-times"></i></button>
                                    </div>
                                    
                                </div>

                                <div class="cart-sub-total" style="display: flex; justify-content: space-between">
                                    Discount Amount<span class="inner-left-md">$ ${data.discount_amount}</span>
                                </div>

                                <div class="cart-grand-total" style="display: flex; justify-content: space-between">
                                    Grand Total<span class="inner-left-md">$ ${data.total_amount}</span>
                                </div>
                            </th>
                        </tr>
                    `)
                }
            }
        })
    }

    couponCalculation()
</script>

<script type="text/javascript">
    function couponRemove() {
        $.ajax({
            type: 'GET',
            url: "{{ url('/coupon-remove') }}",
            dataType: 'json',
            success: function(data) {
                couponCalculation()

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',

                    showConfirmButton: false,
                    timer: 3000
                })
                if ($.isEmptyObject(data.error)) {
                    $('#couponField').show()
                    $('#coupon_name').val('')
                    Toast.fire({
                        type: 'success',
                        icon: 'success',

                        title: data.success
                    })
                } else {
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error
                    })
                }
            }
        })
    }
</script>

@endsection
