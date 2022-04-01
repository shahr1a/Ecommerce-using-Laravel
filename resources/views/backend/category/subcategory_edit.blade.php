@extends('admin.admin_master')
@section('admin')

    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                {{-- ----------- Add Brand Page ------------- --}}
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit SubCategory</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="post" action="{{ route('subcategory.update', $subcategory->id) }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $subcategory->id }}">

                                    <div class="form-group">
                                        <h5>Category Select <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="category_id" class="form-control" aria-invalid="false">
                                                <option value="" selected="" disabled="">Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ $subcategory->category_id == $category->id ? 'selected' : '' }}>
                                                        {{ $category->category_name_en }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>SubCategory Name English <span class="text-danger">*</span>
                                        </h5>
                                        <div class="controls">
                                            <input type="text" name="subcategory_name_en" class="form-control"
                                                value="{{ $subcategory->subcategory_name_en }}" placeholder="">

                                            @error('subcategory_name_en')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>SubCategory Name Bangla <span class="text-danger">*</span>
                                        </h5>
                                        <div class="controls">
                                            <input type="text" name="subcategory_name_bn" class="form-control"
                                                value="{{ $subcategory->subcategory_name_bn }}" placeholder="">

                                            @error('subcategory_name_bn')
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

@endsection
