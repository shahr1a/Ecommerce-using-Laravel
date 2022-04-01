<div class="tab-pane " id="list-container">
    <div class="category-product">
        @foreach ($products as $product)
            <div class="category-product-inner wow fadeInUp">
                <div class="products">
                    <div class="product-list product">
                        <div class="row product-list-row">
                            <div class="col col-sm-4 col-lg-4">
                                <div class="product-image">
                                    <div class="image"> <a
                                            href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_en) }}"><img
                                                src="{{ asset($product->product_thumbnail) }}" alt=""></a> </div>
                                </div>
                                <!-- /.product-image -->
                            </div>
                            <!-- /.col -->
                            <div class="col col-sm-8 col-lg-8">
                                <div class="product-info">
                                    <h3 class="name">
                                        <a
                                            href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_en) }}">
                                            @if (session()->get('language') == 'bangla')
                                                {{ $product->product_name_bn }}
                                            @else
                                                {{ $product->product_name_en }}
                                            @endif
                                        </a>
                                    </h3>
                                    <div class="rating rateit-small"></div>
                                    <div class="product-price">
                                        @if ($product->discount_price == null)
                                            <span class="price">
                                                ${{ $product->selling_price }}
                                            </span>
                                        @else
                                            <span class="price">
                                                ${{ $product->discount_price }} </span> <span
                                                class="price-before-discount">$
                                                {{ $product->selling_price }}</span>
                                        @endif
                                    </div>
                                    <!-- /.product-price -->
                                    <div class="description m-t-10">
                                        @if (session()->get('language') == 'bangla')
                                            {{ $product->short_descp_bn }}
                                        @else
                                            {{ $product->short_descp_en }}
                                        @endif
                                    </div>
                                    <div class="cart clearfix animate-effect">
                                        <div class="action">
                                            <ul class="list-unstyled">
                                                <li class="add-cart-button btn-group">
                                                    <button class="btn btn-primary icon" data-toggle="dropdown"
                                                        type="button"> <i class="fa fa-shopping-cart"></i>
                                                    </button>
                                                    <button class="btn btn-primary cart-btn" type="button">Add to
                                                        cart</button>
                                                </li>
                                                <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html"
                                                        title="Wishlist"> <i class="icon fa fa-heart"></i> </a>
                                                </li>
                                                <li class="lnk"> <a class="add-to-cart" href="detail.html"
                                                        title="Compare"> <i class="fa fa-signal"></i> </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- /.action -->
                                    </div>
                                    <!-- /.cart -->

                                </div>
                                <!-- /.product-info -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.product-list-row -->
                        @php
                            $amount = $product->selling_price - $product->discount_price;
                            $discount = ($amount / $product->selling_price) * 100;
                        @endphp
                        <div>
                            @if ($product->discount_price == null)
                                <div class="tag new"><span>new</span></div>
                            @else
                                <div class="tag hot">
                                    <span>{{ round($discount) }}%</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- /.product-list -->
                </div>
                <!-- /.products -->
            </div>
            <!-- /.category-product-inner -->
        @endforeach

    </div>
    <!-- /.category-product -->
</div>
<!-- /.tab-pane #list-container -->
