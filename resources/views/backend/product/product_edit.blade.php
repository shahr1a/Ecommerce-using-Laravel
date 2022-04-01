@extends('admin.admin_master')
@section('admin')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">

        </div>

        <!-- Main content -->
        <section class="content">

            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Edit Product</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form method="post" action="{{ route('product-update') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <div class="row">
                                    <div class="col-12">
                                        <!-- Start 1st Row -->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Brand Select <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="brand_id" class="form-control" aria-invalid="false">
                                                            <option value="" selected="" disabled="">Select Brand
                                                            </option>
                                                            @foreach ($brands as $brand)
                                                                <option value="{{ $brand->id }}"
                                                                    {{ $brand->id == $product->brand_id ? 'selected' : '' }}>
                                                                    {{ $brand->brand_name_en }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('brand_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Category Select <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="category_id" class="form-control"
                                                            aria-invalid="false">
                                                            <option value="" selected="" disabled="">Select Category
                                                            </option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}"
                                                                    {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                                                    {{ $category->category_name_en }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('category_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>SubCategory Select <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="subcategory_id" class="form-control"
                                                            aria-invalid="false">
                                                            <option value="" selected="" disabled="">Select SubCategory
                                                            </option>
                                                            @foreach ($subcategories as $subcategory)
                                                                <option value="{{ $subcategory->id }}"
                                                                    {{ $subcategory->id == $product->subcategory_id ? 'selected' : '' }}>
                                                                    {{ $subcategory->subcategory_name_en }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('subcategory_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->
                                        </div> <!-- end 1st Row -->

                                        <!-- Start 2nd Row -->
                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Sub-SubCategory Select <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="subsubcategory_id" class="form-control"
                                                            aria-invalid="false">
                                                            <option value="" selected="" disabled="">Select Sub-SubCategory
                                                            </option>
                                                            @foreach ($subsubcategories as $subsubcategory)
                                                                <option value="{{ $subsubcategory->id }}"
                                                                    {{ $subsubcategory->id == $product->subsubcategory_id ? 'selected' : '' }}>
                                                                    {{ $subsubcategory->subsubcategory_name_en }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('subsubcategory_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Product Name En <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_name_en" class="form-control"
                                                            value="{{ $product->product_name_en }}">
                                                        @error('product_name_en')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Product Name Bn <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_name_bn" class="form-control"
                                                            value="{{ $product->product_name_bn }}">
                                                        @error('product_name_bn')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->
                                        </div> <!-- end 2nd Row -->

                                        <!-- Start 3rd Row -->
                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Product Code <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_code" class="form-control"
                                                            value="{{ $product->product_code }}">
                                                        @error('product_code')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Product Quantity <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_qty" class="form-control"
                                                            value="{{ $product->product_qty }}">
                                                        @error('product_qty')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Product Tag En <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_tags_en" class="form-control"
                                                            value="{{ $product->product_tags_en }}"
                                                            data-role="tagsinput">
                                                        @error('product_tags_en')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->
                                        </div> <!-- end 3rd Row -->

                                        <!-- Start 4th Row -->
                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Product Tag Bn <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_tags_bn" class="form-control"
                                                            value="{{ $product->product_tags_bn }}"
                                                            data-role="tagsinput">
                                                        @error('product_tags_bn')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Product Size En <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_size_en" class="form-control"
                                                            value="{{ $product->product_size_en }}"
                                                            data-role="tagsinput">
                                                        @error('product_size_en')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Product Size Bn <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_size_bn" class="form-control"
                                                            value="{{ $product->product_size_bn }}"
                                                            data-role="tagsinput">
                                                        @error('product_size_bn')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->
                                        </div> <!-- end 4th Row -->

                                        <!-- Start 5th Row -->
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Product Color En <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_color_en" class="form-control"
                                                            value="{{ $product->product_color_en }}"
                                                            data-role="tagsinput">
                                                        @error('product_color_en')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Product Color Bn <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_color_bn" class="form-control"
                                                            value="{{ $product->product_color_bn }}"
                                                            data-role="tagsinput">
                                                        @error('product_color_bn')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->
                                        </div> <!-- end 5th Row -->

                                        <!-- Start 6th Row -->
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Product Selling Price <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="selling_price" class="form-control"
                                                            value="{{ $product->selling_price }}">
                                                        @error('selling_price')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Product Discount Price <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="discount_price" class="form-control"
                                                            value="{{ $product->discount_price }}">
                                                        @error('discount_price')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->
                                        </div> <!-- end 6th Row -->

                                        <!-- Start 7th Row -->
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Short Description English <span class="text-danger">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <textarea name="short_descp_en" id="textarea"
                                                            class="form-control"
                                                            placeholder="">{!! $product->short_descp_en !!}</textarea>
                                                        {{-- @error('short_descp_en')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror --}}
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 6 -->

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Short Description Bangla <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <textarea name="short_descp_bn" id="textarea"
                                                            class="form-control"
                                                            placeholder="Textarea text">{!! $product->short_descp_bn !!}</textarea>
                                                        {{-- @error('short_descp_bn')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror --}}
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 6 -->
                                        </div> <!-- end 7th Row -->

                                        <!-- Start 8th Row -->
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Long Description English <span class="text-danger">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <textarea id="editor1" name="long_descp_en" rows="10"
                                                            cols="80">{!! $product->long_descp_en !!}</textarea>
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 6 -->

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Long Description Bangla <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <textarea id="editor2" name="long_descp_bn" rows="10"
                                                            cols="80">{!! $product->long_descp_bn !!}</textarea>
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 6 -->
                                        </div> <!-- end 8th Row -->

                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <fieldset>
                                                    <input type="checkbox" id="checkbox_2" name="hot_deals" value="1"
                                                        {{ $product->hot_deals == 1 ? 'checked' : '' }}>
                                                    <label for="checkbox_2">Hot Deals</label>
                                                </fieldset>
                                                <fieldset>
                                                    <input type="checkbox" id="checkbox_3" name="featured" value="1"
                                                        {{ $product->featured == 1 ? 'checked' : '' }}>
                                                    <label for="checkbox_3">Featured</label>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <fieldset>
                                                    <input type="checkbox" id="checkbox_4" name="special_offer" value="1"
                                                        {{ $product->special_offer == 1 ? 'checked' : '' }}>
                                                    <label for="checkbox_4">Special Offer</label>
                                                </fieldset>
                                                <fieldset>
                                                    <input type="checkbox" id="checkbox_5" name="special_deal" value="1"
                                                        {{ $product->special_deal == 1 ? 'checked' : '' }}>
                                                    <label for="checkbox_5">Special Deals</label>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update">
                                </div>
                            </form>

                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->

        <!-- ///////////// Start Multiple Image Update Are //////////////// -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box bt-3 border-info">
                        <div class="box-header">
                            <h4 class="box-title">Product Multiple Image <strong>Update</strong></h4>
                        </div>
                        <form method="post" action="{{ route('update-product-image') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row row-sm">
                                @foreach ($multiImages as $img)
                                    <div class="col-md-3">
                                        <div class="card">
                                            <img class="card-img-top" src="{{ asset($img->photo_name) }}"
                                                style="height: 180px; width: 280px;" alt="Card image cap">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <a href="{{ route('product.multiimg.delete', $img->id) }}"
                                                        class="btn btn-sm btn-danger" id="delete" title="Delete Data"><i
                                                            class="fa fa-trash"></i></a>

                                                </h5>
                                                <p class="card-text">
                                                <div class="form-group">
                                                    <label class="form-control-label">
                                                        Change Image <span class="tx-danger">*</span>
                                                    </label>
                                                    <input type="file" class="form-control"
                                                        name="multi_img[ {{ $img->id }} ]">
                                                </div>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="form-layout-footer">
                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Image">
                                </div>
                                <br><br>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- ///////////// Start Thumbnail Image Update Are //////////////// -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box bt-3 border-info">
                        <div class="box-header">
                            <h4 class="box-title">Product Thumbnail <strong>Update</strong></h4>
                        </div>
                        <form method="post" action="{{ route('update-product-thumbnail') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <input type="hidden" name="old_img" value="{{ $product->product_thumbnail }}">
                            <div class="row row-sm">

                                <div class="col-md-3">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ asset($product->product_thumbnail) }}"
                                            style="height: 180px; width: 400px;" alt="Card image cap" id="mainThumb">
                                        <div class="card-body">
                                            <p class="card-text">
                                            <div class="form-group">
                                                <label class="form-control-label">
                                                    Change Image <span class="tx-danger">*</span>
                                                </label>
                                                <input type="file" name="product_thumbnail" class="form-control"
                                                    onchange="mainThumUrl(this)">
                                                {{-- <img src="" alt="" id="mainThumb"> --}}
                                            </div>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="form-layout-footer">
                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Thumbnail">
                                </div>
                                <br><br>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="category_id"]').on('change', function() {
                var category_id = $(this).val();
                if (category_id) {
                    $.ajax({
                        url: "{{ url('/category/subcategory/ajax') }}/" + category_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="subsubcategory_id"]').empty();
                            var d = $('select[name="subcategory_id"]').empty();
                            $('select[name="subcategory_id"]').append(
                                '<option value="" disabled selected>Select SubCategory</option>'
                            );
                            $.each(data, function(key, value) {
                                $('select[name="subcategory_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                    .subcategory_name_en + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            })

            $('select[name="subcategory_id"]').on('change', function() {
                var subcategory_id = $(this).val();
                if (subcategory_id) {
                    $.ajax({
                        url: "{{ url('/category/sub-subcategory/ajax') }}/" + subcategory_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            var d = $('select[name="subsubcategory_id"]').empty();
                            $('select[name="subsubcategory_id"]').append(
                                '<option value="" disabled selected>Select Sub-SubCategory</option>'
                            );
                            $.each(data, function(key, value) {
                                $('select[name="subsubcategory_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                    .subsubcategory_name_en + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            })
        })
    </script>

    <script type="text/javascript">
        function mainThumUrl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader()
                reader.onload = function(e) {
                    $('#mainThumb').attr('src', e.target.result)
                }
                reader.readAsDataURL(input.files[0])
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#multiImg').on('change', function() { //on file input change
                if (window.File && window.FileReader && window.FileList && window
                    .Blob) //check File API supported browser
                {
                    var data = $(this)[0].files; //this file data

                    $.each(data, function(index, file) { //loop though each file
                        if (/(\.|\/)(gif|jpe?g|png)$/i.test(file
                                .type)) { //check supported file type
                            var fRead = new FileReader(); //new filereader
                            fRead.onload = (function(file) { //trigger function on successful read
                                return function(e) {
                                    var img = $('<img/>').addClass('thumb').attr('src',
                                            e.target.result).width(80)
                                        .height(80); //create image element 
                                    $('#preview_img').append(
                                        img); //append image to output element
                                };
                            })(file);
                            fRead.readAsDataURL(file); //URL representing the file's data.
                        }
                    });

                } else {
                    alert("Your browser doesn't support File API!"); //if File API is absent
                }
            });
        });
    </script>

@endsection
