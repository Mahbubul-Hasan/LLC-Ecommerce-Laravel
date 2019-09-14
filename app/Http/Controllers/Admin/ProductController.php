<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data["products"] = Product::with(["category", "subImages"])->orderBy("id", "desc")->get();

        return view("admin.product.manege-product", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data["categories"] = Category::all();
        return view("admin.product.add-product", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        return $request->all();
        $validator = Validator::make($request->all(), [
            "p_name"        => "required",
            "category_id"   => "required",
            "p_code"        => "required",
            "p_description" => "required",
            "p_price"       => "required",
            "p_in_stock"    => "required",
            "p_active"      => "required"
        ]);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else
        {
            if ($request->hasFile("p_banner"))
            {
                $imageURL = $this->saveImage($request);

                $product = new Product();
                $product = $product->saveNewProductInfo($request, $product, $imageURL);
            }

            $count = 1;

            if ($request->hasFile("pi_sub_image"))
            {
                foreach ($request->pi_sub_image as $image)
                {
                    if ($count <= 2) {
                        $imageURL = $this->saveSubImage($image);

                        $productImage = new ProductImage();
                        $productImage->saveNewProductImages($product, $productImage, $imageURL);

                        $count++;
                    }
                }
            }

            $this->setSuccessMessage("Product add successfully");
            return redirect()->back();
        }
    }

    public function saveImage($request)
    {
        $image     = $request->file("p_banner");
        $directory = "Image/Product/";
        $name      = random_int(10, 10000000).".".$image->getClientOriginalExtension();
        $image->move($directory, $name);

        return $imageURL = $directory.$name;
    }

    public function saveSubImage($image)
    {
        $directory = "Image/Product/";
        $name      = random_int(10, 10000000).".".$image->getClientOriginalExtension();
        $image->move($directory, $name);

        return $imageURL = $directory.$name;
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
        $data["product"] = Product::with("subImages")->where("id", $id)->first();
        $data["categories"] = Category::all();
        return view("admin.product.edit-product", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "p_name"        => "required",
            "category_id"   => "required",
            "p_code"        => "required",
            "p_description" => "required",
            "p_price"       => "required",
            "p_in_stock"    => "required",
            "p_active"      => "required"
        ]);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else
        {
            $product = Product::with("subImages")->where("id", $id)->first();

            if ($request->hasFile("p_banner"))
            {
                unlink($product->p_banner);
                $imageURL = $this->saveImage($request);
            }
            else
            {
                $imageURL = $product->p_banner;
            }

            $product = $product->saveNewProductInfo($request, $product, $imageURL);



            if ($request->hasFile("pi_sub_image"))
            {
                foreach ($product->subImages as $subImage)
                {
                    unlink($subImage->pi_sub_image);
                }

                $productImages = ProductImage::where("product_id", $product->id)->get();
                foreach ($productImages as $productImage)
                {
                    $productImage->delete();
                }

                $count = 1;

                foreach ($request->pi_sub_image as $image)
                {
                    if ($count <= 2)
                    {
                        $imageURL = $this->saveSubImage($image);

                        $productImage = new ProductImage();
                        $productImage->saveNewProductImages($product, $productImage, $imageURL);

                        $count++;
                    }

                }

            }

            $this->setSuccessMessage("Product edit successfully");
            return redirect()->route("admin.products.index");
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::with("subImages")->where("id", $id)->first();

        unlink($product->p_banner);

        foreach ($product->subImages as $subImage)
        {
            unlink($subImage->pi_sub_image);
        }

        $product->delete();

        $this->setSuccessMessage("Product delete successfully");
        return redirect()->route("admin.products.index");
    }
}
