<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Invoice</title>
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/invoice.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
        integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<body>
    <div class="my-5 page" size="A4" id="invoice">
        <div class="p-5">
            <section class="top-content bb d-flex justify-content-between">
                <div class="logo">
                    <img src="{{ asset('frontend/assets/images/invoicelogo.png') }}" alt="" class="img-fluid">
                </div>
                <div class="top-left">
                    <div class="graphic-path">
                        <p>Invoice</p>
                    </div>
                    <div class="position-relative">
                        <p><strong>Invoice No.</strong> <span>#{{ $order->invoice_no }}</span></p>
                    </div>
                </div>
            </section>

            <section class="store-user mt-5">
                <div class="col-10">
                    <div class="row bb pb-3">
                        <div class="col-7">
                            <p>Supplier, </p>
                            <h2>ProShop Online BD</h2>
                            <p class="address">777 Avenue, <br>aslkdaasd, ada, 123123, <br>Vestavia Hill Al</p>
                            <div class="txn mt-2">TXN: XXXXXX</div>
                        </div>
                        <div class="col-5">
                            <p>Customer, </p>
                            <h2>{{ ucfirst(trans($order->user->name)) }}</h2>
                            @php
                                $division = $order->division->division_name;
                                $district = $order->district->district_name;
                                $state = $order->state->state_name;
                            @endphp
                            <p class="address">{{ $state }}, <br>{{ $district }} -
                                {{ $order->post_code }}, <br>{{ $division }}</p>
                            <div class="txn mt-2">TXN: XXXXXX</div>
                        </div>
                    </div>
                    <div class="row extra-info pt-3">
                        <div class="col-7">
                            <p>Payment Method: <span>{{ $order->payment_type }}</span></p>
                            <p>Order Number: <span>#xxxxxx</span></p>
                        </div>
                        <div class="col-5">
                            <p>Order Date: <span>{{ $order->order_date }}</span></p>
                            <p>Delivery Date: <span>{{ $order->delivery_date }}</span></p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="product-area mt-4">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <td>Item Description</td>
                            <td>Size</td>
                            <td>Color</td>
                            <td>Price</td>
                            <td>Quantity</td>
                            <td>Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderItem as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center q">
                                        <div class="flex-shrink-0">
                                            <img class="mr-3 img-fluid"
                                                src="{{ asset($item->product->product_thumbnail) }}" alt="">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="mt-0 title">
                                                {{ ucfirst(trans($item->product->product_name_en)) }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if ($item->size == null)
                                    @else
                                        {{ $item->size }}
                                    @endif
                                </td>
                                <td>{{ ucfirst(trans($item->color)) }}</td>
                                <td>${{ $item->price }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>${{ $item->price * $item->qty }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
            <section class="balance-info">
                <div class="row">
                    <div class="col-8">
                        <p class="m-0 font-weight-bold"><strong>Note:</strong> </p>
                        <p>{{ $order->notes }}</p>
                    </div>
                    <div class="col-4">
                        <table class="table border-0 table-hover">
                            <tr>
                                <td>Sub Total:</td>
                                <td>${{ $order->amount }}</td>
                            </tr>
                            <tr>
                                <td>Tax: </td>
                                <td>5%</td>
                            </tr>
                            <tr>
                                <td>Delivery:</td>
                                <td>10$</td>
                            </tr>
                            <tfoot>
                                <tr>
                                    <td>Total: </td>
                                    <td>{{ $order->amount + 10 }}</td>
                                </tr>
                            </tfoot>
                        </table>
                        {{-- Signature --}}
                        <div class="col-12">
                            <img src="{{ asset('frontend/assets/images/signature.png') }}" alt=""
                                class="img-fluid">
                            <p class="text-center m-0">Director Signature</p>
                        </div>
                    </div>
                </div>
            </section>

            <img src="{{ asset('frontend/assets/images/cart.png') }}" class="cart-bg" alt="">
            <footer>
                <hr>
                <p class="m-0 text-center">
                    Visit for More Exciting Products<a href="#!"> ProShopOnline Bangladesh</a>
                </p>
            </footer>
        </div>
    </div>
    <button class="btn btn-warning" id="downloadPdf">Download Invoice</button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>

    <script type="text/javascript">
        window.onload = function() {
            document.getElementById("downloadPdf")
                .addEventListener("click", () => {
                    const invoice = this.document.getElementById("invoice");
                    console.log(invoice);
                    console.log(window);
                    var opt = {
                        margin: -5,
                        filename: 'invoice.pdf',
                        image: {
                            type: 'jpeg',
                            quality: 0.98
                        },
                        html2canvas: {
                            scale: 2
                        },
                        jsPDF: {
                            unit: 'in',
                            format: 'a4',
                            orientation: 'portrait'
                        }
                    };
                    html2pdf().from(invoice).set(opt).save();
                })
        }
    </script>


</body>

</html>
