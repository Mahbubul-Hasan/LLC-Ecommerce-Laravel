@extends("admin.master")

@section("body")

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Add Category</li>
        </ol>

        <!-- Icon Cards-->

        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-chart-area"></i>
                Add Category</div>
            <div class="card-body">

                <form class="offset-lg-3 col-lg-6" action="{{ route("admin.categories.store") }}" method="post" enctype="multipart/form-data">
                    @csrf

                    @include("message.message")

                    <div class="form-group row">
                        <label class="control-label col-lg-2" for="c_name">Name:</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="c_name" value="{{ old("c_name") }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-lg-2" for="c_banner">Image:</label>
                        <div class="col-lg-10">
                            <input type="file" class="" name="c_banner" accept="image/*" value="{{ old("c_banner") }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-lg-2" for="c_active"></label>
                        <div class="col-lg-10">
                            <label class="radio-inline">
                                <input type="radio" name="c_active" value="1" checked>Active
                            </label>

                            <label class="radio-inline">
                                <input type="radio" name="c_active" value="0">Inactive
                            </label>
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