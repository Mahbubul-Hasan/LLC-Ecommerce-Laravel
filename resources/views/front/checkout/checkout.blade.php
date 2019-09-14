@extends("front.master")

@section("title")
    Checkout || {{ config("app.name") }}
@endsection

@section("extra-css")
    <link href="{{ asset("/") }}front/css/checkout.css" rel="stylesheet" type="text/css" media="all" />
@endsection

@section("content")

    <div class="product">
        <div class="container">
            <div class="row">
                <div class="col-md-4 order-md-2 mb-4">
                    <h3 class="d-flex justify-content-between align-items-center mb-3 text-center chk_cart">
                        <span class="text-muted">Your cart</span>
                        <span class="badge badge-secondary badge-pill">{{ Cart::count() }}</span>
                    </h3>
                    <ul class="list-group mb-3">
                        @foreach($carts as $cart)
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h5 class="my-0">{{ $cart->name }}</h5>
                                <small class="text-muted">Quantity {{ $cart->qty }}</small>
                            </div>
                            <span class="text-muted">TK. {{ number_format($cart->qty * $cart->price, 2) }}</span>
                        </li>
                        @endforeach
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (BDT)</span>
                            <strong>TK. {{ number_format(session("total_price"), 2) }}</strong>
                        </li>
                    </ul>
                </div>
                <div class="col-md-8 order-md-1">
                    <h2 class="mb-3 text-center chk_header">Billing address</h2>

                    @include("message.message")

                    <form class="needs-validation" action="{{ route("save.order") }}" method="post" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-6">
                                <label for="Name">Name</label>
                                <input type="text" class="form-control" id="name" name="o_customer_name" placeholder="Name" value="{{ auth()->user()->name }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="phone">Phone</label>
                            <input type="email" class="form-control" id="phone" name="o_customer_phone_number" value="{{ auth()->user()->phone_number }}">
                        </div>

                        <div class="mb-3">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="o_address" placeholder="1234 Main St" value="{{ old("o_address") }}" required>
                        </div>

                        <hr class="mb-4">

                        <h3 class="mb-3">Payment</h3>

                        <div class="radio">
                            <label>
                                <input type="radio" name="o_payment_method" value="Cash On Delivery" checked>Cash On Delivery
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="o_payment_method" value="Bkash">Bkash
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="o_payment_method" value="DBBL">DBBL
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="o_payment_method" value="Paypal">Paypal
                            </label>
                        </div>

                        <hr class="mb-4">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
