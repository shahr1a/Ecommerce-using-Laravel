<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span id="pname"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card" style="width: 18rem;">
                            <img src="..." class="card-img-top" alt="..." style="height: 200px; width: 200px;"
                                id="pimage">

                        </div>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-group">
                            <li class="list-group-item">Product Price:
                                <strong class="text-danger">
                                    $<span id="pprice"></span>
                                </strong>
                                {{-- <span id="pprice"></span> --}}
                                <del id="oldprice">$</del>
                            </li>
                            <li class="list-group-item">Product Code: <strong><span id="pcode"></span></strong></li>
                            <li class="list-group-item">Category: <strong><span id="pcategory"></span></strong></li>
                            <li class="list-group-item">Brand: <strong><span id="pbrand"></span></strong></li>
                            <li class="list-group-item">Stock:
                                <span class="badge badge-pill badge-success" id="available"
                                    style="background: green; color: white;"></span>
                                <span class="badge badge-pill badge-danger" id="stockout"
                                    style="background: green; red: white;"></span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="color">Choose Color</label>
                            <select class="form-control" id="color" name="color">

                            </select>
                        </div>

                        <div class="form-group" id="sizeArea">
                            <label for="size">Choose Size</label>
                            <select class="form-control" id="size" name="size">
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="qty">Quantity</label>
                            <input type="number" class="form-control" id="qty" value="1" min="1">
                        </div>
                        <input type="hidden" id="product_id">
                        <button type="submit" class="btn btn-primary mb-2" onclick="addToCart()">Add to Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    // Start Product View with Modal

    function productView(id) {
        // alert(id)

        $.ajax({
            type: 'GET',
            url: '/product/view/modal/' + id,
            dataType: 'json',
            success: function(data) {
                // console.log($data)

                $('#pname').text(data.product.product_name_en)
                $('#product_id').val(id)
                $('#pcode').text(data.product.product_code)
                $('#pcategory').text(data.product.category.category_name_en)
                $('#pbrand').text(data.product.brand.brand_name_en)
                $('#pstock').text(data.product.product_name_en)
                $('#pimage').attr('src', '/' + data.product.product_thumbnail)

                $('#qty').val(1)

                if (data.product.discount_price == null) {
                    $('#oldprice').empty()
                    $('#pprice').text(data.product.selling_price)
                } else {
                    $('#pprice').text(data.product.discount_price)
                    $('#oldprice').text(data.product.selling_price)
                }

                // Color

                $('select[name="color"]').empty()

                $.each(data.color, function(key, value) {
                    $('select[name="color"]').append('<option value=" ' + value + ' ">' + value +
                        '</option>')
                })

                // Size

                $('select[name="size"]').empty()

                $.each(data.size, function(key, value) {
                    $('select[name="size"]').append('<option value=" ' + value + ' ">' + value +
                        '</option>')

                    if (data.size == "") {
                        $('#sizeArea').hide();
                    } else {
                        $('#sizeArea').show();
                    }
                })

                // Stock
                if (data.product.product_qty > 0) {
                    $('#stockout').text('')
                    $('#available').text('In Stock')
                } else {
                    $('#available').text('Out of Stock')
                    $('#stockout').text('Out of Stock')
                }
            }
        })
    }

    function addToCart() {
        var product_name = $('#pname').text()
        var id = $('#product_id').val()
        var color = $('#color option:selected').text()
        var size = $('#size option:selected').text()
        var qty = $('#qty').val()

        $.ajax({
            type: 'POST',
            dataType: "json",
            data: {
                id: id,
                color: color,
                size: size,
                quantity: qty,
                product_name: product_name,
            },
            url: '/cart/data/store/' + id,
            success: function(data) {
                miniCart()
                $('#closeModal').click();
                // console.log(success)

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 3000
                })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        title: data.success
                    })
                } else {
                    Toast.fire({
                        type: 'error',
                        title: data.error
                    })
                }
            }
        })

    }
</script>

<script type="text/javascript">
    function miniCart() {
        $.ajax({
            type: 'GET',
            url: '/product/mini/cart',
            dataType: 'json',
            success: function(response) {

                $('span[id = "cartSubTotal"]').text(response.cartTotal)
                $('span[id = "cartQty"]').text(response.totalItems)

                var miniCart = ""

                $.each(response.carts, function(key, value) {
                    miniCart += `<div class="cart-item product-summary">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <div class="image"> <a href="detail.html"><img
                                                        src="/${value.options.image}"
                                                        alt=""></a> </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <h3 class="name"><a href="/product/details/${value.id}/${value.name}">${value.name}</a></h3>
                                            <div class="price"> ${value.price} * ${value.qty}</div>
                                        </div>
                                        <div class="col-xs-1 action"> <button type="submit" id="${value.rowId}" class="btn btn-sm btn-danger" onclick="miniCartItemRemove(this.id)"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.cart-item -->
                                <div class="clearfix"></div>
                                <hr>`
                });

                $('#miniCart').html(miniCart);
            }
        })
    }

    miniCart()

    // Mini Cart Item Remove

    function miniCartItemRemove(rowId) {
        $.ajax({
            type: 'GET',
            url: '/minicart/product-remove/' + rowId,
            dataType: 'json',
            success: function(data) {
                miniCart()

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 3000
                })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        title: data.success
                    })
                } else {
                    Toast.fire({
                        type: 'error',
                        title: data.error
                    })
                }
            }
        })
    }
</script>
