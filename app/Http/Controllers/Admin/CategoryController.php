<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data["categories"] = Category::all();
        return view("admin.category.manage-category", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.category.add-category");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "c_name"   => "required",
            "c_active" => "required",
            "c_banner" => "required",
        ]);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else
        {
            if ($request->hasFile("c_banner"))
            {
                $imageURL = $this->saveImage($request);

                $category = new Category();
                $category->newCategorySave($request, $category, $imageURL);

                $this->setSuccessMessage("Category add successfully");
                return redirect()->route("admin.categories.create");
            }

            else
            {
                return redirect()->back()->withErrors($validator)->withInput();
            }

        }
    }

    public function saveImage($request)
    {
        $image     = $request->file("c_banner");
        $directory = "Image/Category/";
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
        $data["category"] = Category::find($id);
        return view("admin.category.edit-category", $data);
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
            "c_name"   => "required",
            "c_active" => "required",
            "c_banner" => "required",
        ]);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else
        {
            $category = Category::find($id);

            if ($request->hasFile("c_banner"))
            {
                unlink($category->c_banner);
                $imageURL = $this->saveImage($request);
            }
            else
            {
                $imageURL = $category->c_banner;
            }

            $category->newCategorySave($request, $category, $imageURL);

            $this->setSuccessMessage("Category update successfully");
            return redirect()->route("admin.categories.index");
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
        $category = Category::find($id);

        unlink($category->c_banner);
        $category->delete();

        $this->setSuccessMessage("Category delete successfully");
        return redirect()->route("admin.categories.index");
    }
}
