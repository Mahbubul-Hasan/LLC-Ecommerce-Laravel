@extends("admin.master")

@section("extra-css")
    <link rel="stylesheet" href="{{ asset("/") }}admin/ckeditor/samples/css/samples.css">
    <link rel="stylesheet" href="toolbarconfigurator/lib/codemirror/neo.css">
@endsection

@section("body")

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Add Product</li>
        </ol>

        <!-- Icon Cards-->

        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-chart-area"></i>
                Add Product</div>
            <div class="card-body">

                <form name="productEditForm" class="offset-lg-2 col-lg-8" action="{{ route("admin.products.update", ["id" => $product->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    @include("message.message")

                    <div class="form-group row">
                        <label class="control-label col-lg-2" for="p_name">Name:</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="p_name" value="{{ $product->p_name }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-lg-2" for="category">Category:</label>
                        <div class="col-lg-10">
                            <select class="form-control" id="sel1" name="category_id">
                                <option><-----------------------------------------Select Category-----------------------------------------></option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->c_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-lg-2" for="p_code">Code:</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="p_code" value="{{ $product->p_code }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-lg-2" for="p_price">Price:</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="p_price" value="{{ $product->p_price }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-lg-2" for="p_description">Description:</label>
                        <div class="col-lg-10">
                            <textarea id="editor" class="form-control" name="p_description" rows="4">{{ $product->p_description }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-lg-2" for="p_offer">Offer</label>
                        <div class="col-lg-10">
                            <input type="number" class="form-control" name="p_offer" value="0">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="control-label col-lg-2" for="p_in_stock">Stock</label>
                        <div class="col-lg-10">
                            <label class="radio-inline">
                                <input type="radio" name="p_in_stock" value="1" checked>In Stock
                            </label>

                            <label class="radio-inline pl-3">
                                <input type="radio" name="p_in_stock" value="0">Out of Stock
                            </label>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="control-label col-lg-2" for="p_active">Active</label>
                        <div class="col-lg-10">
                            <label class="radio-inline">
                                <input type="radio" name="p_active" value="1" checked>Active
                            </label>

                            <label class="radio-inline pl-3">
                                <input type="radio" name="p_active" value="0">Inactive
                            </label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-lg-2" for="p_banner">Image:</label>
                        <div class="col-lg-10">
                            <input type="file" class="" name="p_banner" accept="image/*">
                            <img src="{{ asset($product->p_banner) }}" alt="{{ $product->p_name }}" width="100" height="80">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-lg-2" for="pi_sub_image">Sub Image:</label>
                        <div class="col-lg-10">
                            <input type="file" class="" name="pi_sub_image[]" accept="image/*" multiple>
                            @foreach($product->subImages as $subImage)
                                <img src="{{ asset($subImage->pi_sub_image) }}" alt="{{ $product->p_name }}" width="100" height="80">
                            @endforeach
                            <p class="text-warning">Select only two files</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-info btn-block">Save</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>

@endsection

@section("extra-js")
    <script src="{{ asset("/") }}admin/ckeditor/ckeditor.js"></script>
    <script src="{{ asset("/") }}admin/ckeditor/samples/js/sample.js"></script>

    <script>
        initSample();
    </script>

    <script>
        document.forms["productEditForm"].elements["category_id"].value = "{{ $product->category_id }}"
    </script>

@endsection