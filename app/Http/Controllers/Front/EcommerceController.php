<?php

namespace App\Http\Controllers\Front;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Notifications\OrderEmailNotification;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class EcommerceController extends Controller
{
    public function index()
    {
        $data["products"] = Product::select("id", "p_name", "p_slug", "p_banner", "p_price")->where("p_offer", 0)->where("p_active", 1)->orderBy("id", "desc")->paginate(12);
        $data["offer_products"] = Product::select("id", "p_name", "p_slug", "p_banner", "p_price", "p_sale_price", "p_offer")->where("p_offer", ">", 0)->where("p_active", 1)->orderBy("id", "desc")->take(4)->get();
        return view("front.home.home", $data);
    }

    public function productDetails($slug)
    {
        $data["product"] = Product::with("subImages")->where("p_slug", $slug)->first();

        $data["category"] = Category::select("c_slug")->where("id", $data["product"]->category_id)->first();

        $data["category_products"] = DB::table("categories")
            ->join("products", "categories.id", "products.category_id")
            ->select("categories.c_slug", "products.id", "products.p_name", "products.p_slug", "products.p_banner", "products.p_price", "products.p_sale_price", "products.p_offer")
            ->where("categories.id", $data["product"]->category_id)
            ->where("products.p_active", 1)
            ->orderBy("products.id", "desc")
            ->take(5)
            ->get();
//        return $data["category_products"];
//        return $data;
        return view("front.product-details.product-details", $data);
    }

    public function categoryProducts($slug)
    {
        $data["category_products"] = Category::with("products")->where("c_slug", $slug)->first();

        $data["offer_products"] = Product::select("id", "p_name", "p_slug", "p_banner", "p_price", "p_sale_price", "p_offer")->where("p_offer", ">", 0)->where("p_active", 1)->orderBy("id", "desc")->take(4)->get();

        return view("front.category-products.category-products", $data);
    }

    public function offerProducts()
    {

        $data["offer_products"] = Product::select("id", "p_name", "p_slug", "p_banner", "p_price", "p_sale_price", "p_offer")->where("p_offer", ">", 0)->where("p_active", 1)->orderBy("id", "desc")->get();

        return view("front.offer-products.offer-products", $data);
    }





    public function checkout()
    {
        $data["carts"] = Cart::content();
        return view("front.checkout.checkout", $data);
    }

    public function saveOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
           "o_customer_name"         => "required",
           "o_customer_phone_number" => "required|min:11|max:13",
           "o_address"               => "required",
        ]);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else
        {
            $order = new Order();
            $order->newOrderSave($request, $order);

            $carts = Cart::content();
            foreach ($carts as $cart)
            {
                $orderProduct = new OrderProduct();
                $orderProduct->newOrderSave($cart, $order, $orderProduct);
            }

            Notification::send(auth()->user(), new OrderEmailNotification($order));
//            auth()->user()->notify(new OrderEmailNotification($order));

            Cart::destroy();
            return redirect()->route("/");
        }
    }
}
