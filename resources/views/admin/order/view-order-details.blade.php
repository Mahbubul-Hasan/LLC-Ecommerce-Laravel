@extends("admin.master")

@section("body")

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">View Order Details</li>
        </ol>

        <!-- Icon Cards-->

        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-chart-area"></i>
                Order Customer Info</div>
            <div class="card-body">

                <div class="table-responsive">

                    @include("message.message")

                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <tr>
                            <th>Customer Name</th>
                            <td>{{ $order->o_customer_name }}</td>
                        </tr>

                        <tr>
                            <th>Phone Number</th>
                            <td>{{ $order->o_customer_phone_number }}</td>
                        </tr>

                        <tr>
                            <th>Address</th>
                            <td>{{ $order->o_address }}</td>
                        </tr>

                        <tr>
                            <th>Total Price (BDT)</th>
                            <td>TK. {{ $order->o_total_price }}</td>
                        </tr>

                        <tr>
                            <th>Discount Price (BDT)</th>
                            <td>TK. {{ $order->o_discount_price }}</td>
                        </tr>

                        <tr>
                            <th>Paid Price (BDT)</th>
                            <td>TK. {{ $order->o_paid_price }}</td>
                        </tr>

                        <tr>
                            <th>Payment Method</th>
                            <td>{{ $order->o_payment_method }}</td>
                        </tr>

                        <tr>
                            <th>Payment Status</th>
                            <td>{{ $order->o_payment_status }}</td>
                        </tr>

                        <tr>
                            <th>Date & Time</th>
                            <td>{{ $order->created_at }}</td>
                        </tr>
                    </table>

                </div>

            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-chart-area"></i>
                Order Product Info</div>
            <div class="card-body">

                <div class="table-responsive">

                    @include("message.message")

                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>Serial NO</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Code</th>
                            <th>Unit price (BDT)</th>
                            <th>Quantity</th>
                            <th>Price (BDT)</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i = 1)
                        @foreach($order->products as $product)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $product->product->p_name }}</td>
                            <td>
                                <img src="{{ asset($product->product->p_banner) }}" alt="{{ $product->product->p_name }}" width="80">
                            </td>
                            <td>{{ $product->product->p_code }}</td>
                            <td>TK. {{ $U_price = ($product->product->p_sale_price > 0) ? $product->product->p_sale_price : $product->product->p_price }}</td>
                            <td>{{ $quantity = $product->op_quantity }}</td>
                            <td>TK. {{ number_format($U_price * $quantity, 2) }}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>Total (BDT)</th>
                            <th>TK. {{ $order->o_total_price }}</th>
                        </tr>
                        </tbody>
                    </table>

                </div>

            </div>
        </div>

    </div>

@endsection