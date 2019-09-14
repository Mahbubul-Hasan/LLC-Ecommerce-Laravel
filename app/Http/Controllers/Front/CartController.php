<?php

namespace App\Http\Controllers\Front;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data["carts"] = Cart::content();
        return view("front.cart.cart", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::find($request->product_id);

        $cart = Cart::add([
            'id'      => $product->id,
            'name'    => $product->p_name,
            'qty'     => 1,
            'price'   => ($product->p_sale_price > 0) ? $product->p_sale_price : $product->p_price,
            'options' => [
                'banner'    => $product->p_banner
            ]
        ]);

        $this->setSuccessMessage('"'.$cart->name.'" added into cart');
        return redirect()->route("carts.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $rowId)
    {
        Cart::update($rowId, $request->quantity);

        $this->setSuccessMessage("Update product's quantity  successfully");
        return redirect()->route("carts.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($rowId)
    {
        Cart::remove($rowId);

        $this->setSuccessMessage("Remove product from cart successfully");
        return redirect()->route("carts.index");
    }

    public function cartsRemoveAll()
    {
        Cart::destroy();

        $this->setErrorMessage("Cart is empty");
        return redirect()->route("carts.index");
    }
}
