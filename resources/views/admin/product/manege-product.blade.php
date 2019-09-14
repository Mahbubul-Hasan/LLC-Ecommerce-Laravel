@extends("admin.master")

@section("body")

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Manage Product</li>
        </ol>

        <!-- Icon Cards-->

        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-chart-area"></i>
                Manage Product</div>
            <div class="card-body">

                <div>
                    <a href="{{ route("admin.products.create") }}" class="btn btn-success mb-3">Add Product</a>
                </div>

                <div class="table-responsive">

                    @include("message.message")

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Serial NO</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Code</th>
                            <th>Price</th>
                            <th>Sale price</th>
                            <th>Offer</th>
                            <th>Description</th>
                            <th>Stock</th>
                            <th>Active</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Serial NO</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Code</th>
                            <th>Price</th>
                            <th>Sale price</th>
                            <th>Offer</th>
                            <th>Description</th>
                            <th>Stock</th>
                            <th>Active</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @php($i = 1)
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>
                                <img src="{{ asset($product->p_banner) }}" alt="Photo" width="100" height="80">
                                @foreach($product->subImages as $subImage)
                                    <img class="p-1 pb-0" src="{{ asset($subImage->pi_sub_image) }}" alt="Photo" width="100" height="80">
                                @endforeach
                            </td>
                            <td>{{ $product->p_name }}</td>
                            <td>{{ $product->category->c_name }}</td>
                            <td>{{ $product->p_code }}</td>
                            <td>{{ $product->p_price }}</td>
                            <td>{{ $product->p_sale_price }}</td>
                            <td>{{ $product->p_offer }}%</td>
                            <td>{!! $product->p_description !!}</td>
                            <td>{{ ($product->p_in_stock == 0) ? "Out of Stock" : "In Stock" }}</td>
                            <td>{{ ($product->p_active == 0) ? "Inactive" : "Active" }}</td>
                            <td>
                                <div class="row">
                                    <div class="pl-3">
                                        <a href="{{ route("admin.products.edit", ["id" => $product->id]) }}" class="btn btn-info btn-sm">
                                            <span class="fa fa-edit"></span>
                                        </a>
                                    </div>

                                    <div class="">
                                        <form  class="float-left" action="{{ route("admin.products.destroy", ["id" => $product->id ]) }}" method="post">
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