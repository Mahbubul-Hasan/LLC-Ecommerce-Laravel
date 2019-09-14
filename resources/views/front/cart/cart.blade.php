@extends("front.master")

@section("title")
    Cart || {{ config("app.name") }}
@endsection

@section("content")

    <div class="product">
        <div class="container">
            @if(Cart::count() > 0)
            <div class="well">

                @include("message.message")

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Serial No</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Unit Price (BDT)</th>
                        <th>Quantity</th>
                        <th>Total (BDT)</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($i = 1)
                    @php($g_total = 0)
                    @foreach($carts as $cart)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>
                            <img src="{{ asset($cart->options->banner) }}" alt="" width="80">
                        </td>
                        <td>{{ $cart->name }}</td>
                        <td>Tk. {{ number_format($price = $cart->price, 2) }}</td>
                        <td>
                            <form class="form-inline" action="{{ route("carts.update", ["rowId" => $cart->rowId]) }}" method="post">
                                @csrf
                                @method("PUT")
                                <input class="form-control" type="number" name="quantity" value="{{ $quantity = $cart->qty }}" style="width: 55px"/>
                                <input class="btn btn-info" type="submit" name="update" value="Update"/>
                            </form>
                        </td>
                        <td>TK. {{ number_format($total = $price * $quantity, 2) }}</td>
                        @php($g_total = $g_total + $total)
                        <td>
                            <form action="{{ route("carts.destroy",["rowId" => $cart->rowId] ) }}" method="post" onclick="return confirm('Are your sure')">
                                @csrf
                                @method("DELETE")
                                <input class="btn btn-sm btn-danger" type="submit" name="update" value="Remove"/>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="6"></td>
                    </tr>

                    <tr>
                        <td colspan="4"></td>
                        <th>Total (BDT)</th>
                        <th>
                            TK. {{ number_format($g_total, 2) }}
                            {{ session(["total_price" => $g_total]) }}
                        </th>
                        <td>
                            <a href="{{ route("carts.removeAll")}}" class="btn btn-sm btn-danger">Remove all</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <a href="{{ route("/") }}" class="btn btn-primary btn-block">Continue Reading</a>
                </div>
                <div class="col-md-6">
                    <a href="{{ route("checkout") }}" class="btn btn-success btn-block">Checkout</a>
                </div>
            </div>

            @else
                <div class="alert alert-warning">
                    Cart is empty
                </div>
            @endif

        </div>
    </div>

@endsection