@php
$prefix = Request::route()->getPrefix();
$route = Route::current()->getName();
@endphp


<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <div class="user-profile">
            <div class="ulogo">
                <a href="/admin/dashboard">
                    <!-- logo for regular state and mobile devices -->
                    <div class="d-flex align-items-center justify-content-center">
                        <img src="{{ asset('backend/images/logo-dark.png') }}" alt="">
                        <h3><b>Pro</b> Shop</h3>
                    </div>
                </a>
            </div>
        </div>

        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree">

            <li class="{{ $route == 'dashboard' ? 'active' : '' }}">
                <a href="{{ url('admin/dashboard') }}">
                    <i data-feather="pie-chart"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="treeview {{ $prefix == '/brand' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="message-circle"></i>
                    <span>Brands</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'all.brand' ? 'active' : '' }}"><a href="{{ route('all.brand') }}"><i
                                class="ti-more"></i>All Brand</a></li>
                    {{-- <li><a href="calendar.html"><i class="ti-more"></i>Calendar</a></li> --}}
                </ul>
            </li>

            <li class="treeview {{ $prefix == '/category' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="message-circle"></i>
                    <span>Category</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'all.category' ? 'active' : '' }}"><a
                            href="{{ route('all.category') }}"><i class="ti-more"></i>All Categories</a></li>
                    <li class="{{ $route == 'all.subcategory' ? 'active' : '' }}"><a
                            href="{{ route('all.subcategory') }}"><i class="ti-more"></i>All Sub
                            Categories</a>
                    </li>
                    <li class="{{ $route == 'all.subsubcategory' ? 'active' : '' }}">
                        <a href="{{ route('all.subsubcategory') }}">
                            <i class="ti-more"></i>
                            All Sub->SubCategory
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview {{ $prefix == '/product' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="message-circle"></i>
                    <span>Products</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'add-product' ? 'active' : '' }}"><a
                            href="{{ route('add-product') }}"><i class="ti-more"></i>Add Products</a></li>
                    <li class="{{ $route == 'manage-product' ? 'active' : '' }}"><a
                            href="{{ route('manage-product') }}"><i class="ti-more"></i>Manage Products</a>
                    </li>
                </ul>
            </li>

            <!-- /////////////// Slider Menu ///////////////// -->

            <li class="treeview {{ $prefix == '/slider' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="message-circle"></i>
                    <span>Slider</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'manage-slider' ? 'active' : '' }}">
                        <a href="{{ route('manage-slider') }}"><i class="ti-more"></i>Manage Slider</a>
                    </li>
                </ul>
            </li>

            <li class="treeview {{ $prefix == '/coupons' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="message-circle"></i>
                    <span>Coupons</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'manage-coupon' ? 'active' : '' }}">
                        <a href="{{ route('manage-coupon') }}"><i class="ti-more"></i>Manage Coupon</a>
                    </li>
                </ul>
            </li>

            <li class="treeview {{ $prefix == '/shipping' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="message-circle"></i>
                    <span>Shipping Area</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'manage-division' ? 'active' : '' }}">
                        <a href="{{ route('manage-division') }}"><i class="ti-more"></i>Shipping Division</a>
                    </li>
                    <li class="{{ $route == 'manage-district' ? 'active' : '' }}">
                        <a href="{{ route('manage-district') }}"><i class="ti-more"></i>Shipping District</a>
                    </li>
                    <li class="{{ $route == 'manage-state' ? 'active' : '' }}">
                        <a href="{{ route('manage-state') }}"><i class="ti-more"></i>Shipping State</a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i data-feather="mail"></i> <span>Mailbox</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="mailbox_inbox.html"><i class="ti-more"></i>Inbox</a></li>
                    <li><a href="mailbox_compose.html"><i class="ti-more"></i>Compose</a></li>
                    <li><a href="mailbox_read_mail.html"><i class="ti-more"></i>Read</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i data-feather="file"></i>
                    <span>Pages</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="profile.html"><i class="ti-more"></i>Profile</a></li>
                    <li><a href="invoice.html"><i class="ti-more"></i>Invoice</a></li>
                    <li><a href="gallery.html"><i class="ti-more"></i>Gallery</a></li>
                    <li><a href="faq.html"><i class="ti-more"></i>FAQs</a></li>
                    <li><a href="timeline.html"><i class="ti-more"></i>Timeline</a></li>
                </ul>
            </li>

            <li class="header nav-small-cap">User Interface</li>

            <li class="treeview {{ $prefix == '/orders' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="message-circle"></i>
                    <span>Orders</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'orders-all' ? 'active' : '' }}">
                        <a href="{{ route('orders-all') }}"><i class="ti-more"></i>All Orders</a>
                    </li>
                    <li class="{{ $route == 'orders-pending' ? 'active' : '' }}">
                        <a href="{{ route('orders-pending') }}"><i class="ti-more"></i>Pending Orders</a>
                    </li>
                    <li class="{{ $route == 'orders-confirmed' ? 'active' : '' }}">
                        <a href="{{ route('orders-confirmed') }}"><i class="ti-more"></i>Confirmed Orders</a>
                    </li>
                    <li class="{{ $route == 'orders-processing' ? 'active' : '' }}">
                        <a href="{{ route('orders-processing') }}"><i class="ti-more"></i>Processing
                            Orders</a>
                    </li>
                    <li class="{{ $route == 'orders-picked' ? 'active' : '' }}">
                        <a href="{{ route('orders-picked') }}"><i class="ti-more"></i>Picked
                            Orders</a>
                    </li>
                    <li class="{{ $route == 'orders-shipped' ? 'active' : '' }}">
                        <a href="{{ route('orders-shipped') }}"><i class="ti-more"></i>Shipped
                            Orders</a>
                    </li>
                    <li class="{{ $route == 'orders-delivered' ? 'active' : '' }}">
                        <a href="{{ route('orders-delivered') }}"><i class="ti-more"></i>Delivered
                            Orders</a>
                    </li>
                    <li class="{{ $route == 'orders-canceled' ? 'active' : '' }}">
                        <a href="{{ route('orders-canceled') }}"><i class="ti-more"></i>Canceled
                            Orders</a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i data-feather="credit-card"></i>
                    <span>Cards</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="card_advanced.html"><i class="ti-more"></i>Advanced Cards</a></li>
                    <li><a href="card_basic.html"><i class="ti-more"></i>Basic Cards</a></li>
                    <li><a href="card_color.html"><i class="ti-more"></i>Cards Color</a></li>
                </ul>
            </li>
        </ul>
    </section>

    <div class="sidebar-footer">
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title=""
            data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
        <!-- item-->
        <a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title=""
            data-original-title="Email"><i class="ti-email"></i></a>
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title=""
            data-original-title="Logout"><i class="ti-lock"></i></a>
    </div>
</aside>
