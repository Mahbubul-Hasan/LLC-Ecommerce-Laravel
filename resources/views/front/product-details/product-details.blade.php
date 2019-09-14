@extends("front.master")

@section("title")
    Product Details || {{ config("app.name") }}
@endsection

@section("extra-css")
    <link rel="stylesheet" href="{{ asset("/") }}front/css/flexslider.css" type="text/css" media="screen" />
@endsection


@section("content")

    <div class="product">
        <div class="container">
            <div class="product-price1">
                <div class="top-sing">
                    <div class="col-md-7 single-top">
                        <div class="flexslider">
                            <ul class="slides">
                                <li data-thumb="{{ asset($product->p_banner) }}">
                                    <div class="thumb-image">
                                        <img src="{{ asset($product->p_banner) }}" data-imagezoom="true" class="img-responsive" alt="" />
                                    </div>
                                </li>
                                @foreach($product->subImages as $subImage)
                                <li data-thumb="{{ asset($subImage->pi_sub_image) }}">
                                    <div class="thumb-image">
                                        <img src="{{ asset($subImage->pi_sub_image) }}" data-imagezoom="true" class="img-responsive" alt=""/>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <script src="{{ asset("/") }}front/js/imagezoom.js"></script>
                        <script defer src="{{ asset("/") }}front/js/jquery.flexslider.js"></script>
                        <script>
                            // Can also be used with $(document).ready()
                            $(window).load(function() {
                                $('.flexslider').flexslider({
                                    animation: "slide",
                                    controlNav: "thumbnails"
                                });
                            });
                        </script>

                    </div>
                    <div class="col-md-5 single-top-in simpleCart_shelfItem">
                        <div class="single-para">
                            <h4>{{ $product->p_name }}</h4>
                            <h4 style="padding-top: 20px; font-size: larger">Product Code: {{ $product->p_code }}</h4>
                            <h5 class="item_price">TK.
                                @if($product->p_sale_price > 0)
                                    {{ $product->p_sale_price }} <strike>{{ $product->p_price }}</strike>
                                @else
                                    {{ $product->p_price }}
                                @endif
                            </h5>
                            <p class="para">{!! $product->p_description !!}</p>
                            <div class="prdt-info-grid">
                                <p>{{ ($product->p_in_stock == 1) ? "In Stock" : "Out of Stock"}}</p>
                            </div>
                            <form action="{{ route("carts.store") }}" method="post">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input class="add-cart item_add" type="submit" name="addToCart" value="ADD TO CART">
                            </form>
                        </div>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>

            <div class="bottom-prdt">
                <div class="btm-grid-sec">
                    <h2 class="text-center" style="padding-bottom: 20px">Similar Products</h2>
                    @if($category_products->count() > 4)
                    <a class="text-right" href="{{ route("category.products", ["slug" => $category->c_slug]) }}">
                        <h5 style="padding-right: 20px">See all</h5>
                    </a>
                    @endif
                    @foreach($category_products as $product)
                    <div class="col-md-2 btm-grid">
                        <a href="{{ route("product.details", ["slug" => $product->p_slug]) }}">
                            <img class="img-responsive" src="{{ asset($product->p_banner) }}" alt=""/>
                            <h4 style="padding-top: 20px">{{ $product->p_name }}</h4>
                            <span>
                                @if($product->p_sale_price > 0)
                                    <p>TK. {{ $product->p_sale_price }}</p>
                                    <span>TK. <strike>{{ $product->p_price }}</strike> [{{ $product->p_offer }}% Off]</span>
                                @else
                                    <span>TK. {{ $product->p_price }}</span>
                                @endif
                            </span>
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
    </div>

@endsection