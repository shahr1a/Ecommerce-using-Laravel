@extends('admin.admin_master')
@section('admin')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                {{-- ----------- Add Sub->SubCategory Section ------------- --}}
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Sub->SubCategory</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="post" action="{{ route('subsubcategory.update') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $subsubcategory->id }}">
                                    <div class="form-group">
                                        <h5>Category Select <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="category_id" class="form-control" aria-invalid="false">
                                                <option value="" selected="" disabled="">Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ $category->id == $subsubcategory->category_id ? 'selected' : '' }}>
                                                        {{ $category->category_name_en }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>SubCategory Select <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="subcategory_id" class="form-control" aria-invalid="false">
                                                <option value="" selected="" disabled="">Select SubCategory</option>
                                                @foreach ($subcategories as $subcategory)
                                                    @if ($subcategory->category_id == $subsubcategory->category_id) {
                                                        <option value="{{ $subcategory->id }}"
                                                            {{ $subcategory->id == $subsubcategory->subcategory_id ? 'selected' : '' }}>
                                                            {{ $subcategory->subcategory_name_en }}</option>
                                                        }
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('subcategory_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Sub->SubCategory Name English <span class="text-danger">*</span>
                                        </h5>
                                        <div class="controls">
                                            <input type="text" name="subsubcategory_name_en" class="form-control"
                                                placeholder="" value="{{ $subsubcategory->subsubcategory_name_en }}">

                                            @error('subsubcategory_name_en')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Sub->SubCategory Name Bangla <span class="text-danger">*</span>
                                        </h5>
                                        <div class="controls">
                                            <input type="text" name="subsubcategory_name_bn" class="form-control"
                                                placeholder="" value="{{ $subsubcategory->subsubcategory_name_bn }}">

                                            @error('subsubcategory_name_bn')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="text-xs-right">
                                        <input type="submit" value="Update" class="btn btn-rounded btn-primary mb-5">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
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
                            var d = $('select[name="subcategory_id"]').empty();
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
        })
    </script>

@endsection
