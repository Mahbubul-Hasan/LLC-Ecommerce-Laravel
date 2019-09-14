@extends("front.master")

@section("title")
    Category Products || {{ config("app.name") }}
@endsection
@section("extra-css")

    <link href="{{ asset("/") }}front/css/form.css" rel="stylesheet" type="text/css" media="all" />
    <!-- the jScrollPane script -->
    <script type="text/javascript" src="{{ asset("/") }}front/js/jquery.jscrollpane.min.js"></script>
    <script type="text/javascript" id="sourcecode">
        $(function()
        {
            $('.scroll-pane').jScrollPane();
        });
    </script>
    <!-- //the jScrollPane script -->

@endsection

@section("content")

    @if($offer_products->count() > 0)
        <div class="items">
            <div class="container">
                <div class="items-sec">
                    <h2 class="text-center pb-5">Offer Products</h2>
                    @foreach($offer_products as $product)
                        <div class="col-md-3 feature-grid">
                            <a href="{{ route("product.details", ["slug" => $product->p_slug]) }}">
                                <img src="{{ asset($product->p_banner) }}" alt=""/>
                                <div class="arrival-info">
                                    <h4>{{ $product->p_name }}</h4>
                                    <p>TK. {{ $product->p_sale_price }}</p>
                                    <span class="pric1"><del>TK. {{ $product->p_price }}</del></span>
                                    <span class="disc">[{{ $product->p_offer }}% Off]</span>
                                </div>
                                <div class="viw">
                                    <a href="{{ route("product.details", ["slug" => $product->p_slug]) }}"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>View</a>
                                </div>
                            </a>
                            <form action="{{ route("carts.store") }}" method="post">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input class="add-cart item_add btn btn-block" type="submit" name="addToCart" value="ADD TO CART">
                            </form>
                        </div>
                    @endforeach
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    @endif


@endsection