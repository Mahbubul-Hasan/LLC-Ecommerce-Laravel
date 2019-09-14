<div class="header-top">
<div class="header-bottom">
    <div class="logo">
        <h1>
            <a href="{{ route("/") }}">{{ config("app.name") }}</a>
        </h1>
    </div>
    <!---->
    <div class="top-nav">
        <ul class="memenu skyblue">

            <li class="grid"><a href="#">Categories</a>
                <div class="mepanel">
                    <div class="row">
                        <div class="col1 me-one">
                            <ul>
                                @foreach($categories_1 as $category)
                                    <li><a href="{{ route("category.products", ["slug" => $category->c_slug]) }}">{{ $category->c_name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col1 me-one">
                            <ul>
                                @foreach($categories_2 as $category)
                                    <li><a href="{{ route("category.products", ["slug" => $category->c_slug]) }}">{{ $category->c_name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
            <li class="grid"><a href="#">Accessories</a>
                <div class="mepanel">
                    <div class="row">
                        <div class="col1 me-one">
                            <h4>Shop</h4>
                            <ul>
                                <li><a href="product.html">New Arrivals</a></li>
                                <li><a href="product.html">Home</a></li>
                                <li><a href="product.html">Decorates</a></li>
                                <li><a href="product.html">Accessories</a></li>
                                <li><a href="product.html">Kids</a></li>
                                <li><a href="product.html">Login</a></li>
                                <li><a href="product.html">Brands</a></li>
                                <li><a href="product.html">My Shopping Bag</a></li>
                            </ul>
                        </div>
                        <div class="col1 me-one">
                            <h4>Type</h4>
                            <ul>
                                <li><a href="product.html">Diwali Lights</a></li>
                                <li><a href="product.html">Tube Lights</a></li>
                                <li><a href="product.html">Bulbs</a></li>
                                <li><a href="product.html">Ceiling Lights</a></li>
                                <li><a href="product.html">Accessories</a></li>
                                <li><a href="product.html">Lanterns</a></li>
                            </ul>
                        </div>
                        <div class="col1 me-one">
                            <h4>Popular Brands</h4>
                            <ul>
                                <li><a href="product.html">Everyday</a></li>
                                <li><a href="product.html">Philips</a></li>
                                <li><a href="product.html">Havells</a></li>
                                <li><a href="product.html">Wipro</a></li>
                                <li><a href="product.html">Jaguar</a></li>
                                <li><a href="product.html">Ave</a></li>
                                <li><a href="product.html">Gold Medal</a></li>
                                <li><a href="product.html">Anchor</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
            <li class="grid"><a href="contact.html">Contact</a></li>
        </ul>
    </div>
    <!---->
    <div class="cart box_1">
        @guest()
        <a href="{{ route("login") }}" class="home-login">Login</a>
        <a href="" class="home-login">Register</a>
        @endguest

        @auth()
        <a href="" class="home-login">Profile</a>
        <a href="{{ route("logout") }}" class="home-login">Logout</a>
        @endauth

        <a href="{{ route("carts.index") }}" class="btn btn-info">
            <span class="glyphicon glyphicon-shopping-cart home-login" aria-hidden="true"> ({{ Cart::count() }})</span>
        </a>
        <div class="clearfix"> </div>
    </div>
    <div class="clearfix"> </div>
    <!---->
</div>
<div class="clearfix"> </div>
</div>