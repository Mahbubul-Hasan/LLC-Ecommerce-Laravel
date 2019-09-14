<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function saveNewProductImages($product, $productImage, $imageURL)
    {
        $productImage->product_id   = $product->id;
        $productImage->pi_sub_image = $imageURL;

        $productImage->save();
    }
}
