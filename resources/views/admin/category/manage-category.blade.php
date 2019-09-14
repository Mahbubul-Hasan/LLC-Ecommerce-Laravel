@extends("admin.master")

@section("body")

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Manage Category</li>
        </ol>

        <!-- Icon Cards-->

        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-chart-area"></i>
                Manage Category</div>
            <div class="card-body">
                <div>
                    <a href="{{ route("admin.categories.create") }}" class="btn btn-success mb-3">Add Category</a>
                </div>

                <div class="table-responsive">

                    @include("message.message")

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Serial NO</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Publication Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Serial NO</th>
                            <th>Image</th>
                            <th>name</th>
                            <th>publication_status</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @php($i = 1)
                        @foreach($categories as $category)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>
                                <img src="{{ asset($category->c_banner) }}" alt="{{ $category->c_name }}" width="80">
                            </td>
                            <td>{{ $category->c_name }}</td>
                            <td>{{ $category->c_active == 1 ? "Active" : "Inactive" }}</td>
                            <td>
                                <div class="row">
                                    <div class="pl-3">
                                        <a href="{{ route("admin.categories.edit", ["id" => $category->id]) }}" class="btn btn-info btn-sm">
                                            <span class="fa fa-edit"></span>
                                        </a>
                                    </div>

                                    <div class="">
                                        <form  class="float-left" action="{{ route("admin.categories.destroy", ["id" => $category->id ]) }}" method="post">
                                            @csrf
                                            @method("DELETE")
                                            <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Are your sure')"><span class="fa fa-trash"></span></button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>

@endsection