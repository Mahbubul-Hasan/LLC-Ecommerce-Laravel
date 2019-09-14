@extends("front.master")

@section("title")
    Home || {{ config("app.name") }}
@endsection

@section("content")

    @include("front.includes.image-slider")

    @if($offer_products->count() > 0)
    <div class="items">
        <div class="container">
            <div class="items-sec">
                <h2 class="text-center pb-5">Offer Products</h2>
                <a class="text-right" href="{{ route("offer.products") }}"><h5 style="padding-right: 20px">See all</h5></a>
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

    <div class="items">
        <div class="container">
            <div class="items-sec">
                <h2 class="text-center pb-5">Products</h2>
                @foreach($products as $product)
                <div class="col-md-3 feature-grid">
                    <a href="{{ route("product.details", ["slug" => $product->p_slug]) }}">
                        <img src="{{ asset($product->p_banner) }}" alt=""/>
                        <div class="arrival-info">
                            <h4>{{ $product->p_name }}</h4>
                            <p>TK. {{ $product->p_price }}</p>
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
            {{ $products->links() }}
        </div>
    </div>

    <!---->
    <div class="offers">
        <div class="container">
            <h3>End of Season Sale</h3>
            <div class="offer-grids">
                <div class="col-md-6 grid-left">
                    <a href="#"><div class="offer-grid1">
                            <div class="ofr-pic">
                                <img src="{{ asset("/") }}front/images/ofr2.jpeg" class="img-responsive" alt=""/>
                            </div>
                            <div class="ofr-pic-info">
                                <h4>Emergency Lights <br>& Led Bulds</h4>
                                <span>UP TO 60% OFF</span>
                                <p>Shop Now</p>
                            </div>
                            <div class="clearfix"></div>
                        </div></a>
                </div>
                <div class="col-md-6 grid-right">
                    <a href="#"><div class="offer-grid2">
                            <div class="ofr-pic-info2">
                                <h4>Flat Discount</h4>
                                <span>UP TO 30% OFF</span>
                                <h5>Outdoor Gate Lights</h5>
                                <p>Shop Now</p>
                            </div>
                            <div class="ofr-pic2">
                                <img src="{{ asset("/") }}front/images/ofr3.jpg" class="img-responsive" alt=""/>
                            </div>
                            <div class="clearfix"></div>
                        </div></a>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

@endsection