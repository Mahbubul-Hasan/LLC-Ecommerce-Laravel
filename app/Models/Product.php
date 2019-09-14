<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property int $category_id
 * @property string $p_name
 * @property string $p_slug
 * @property string $p_code
 * @property string $p_banner
 * @property string $p_description
 * @property float $p_price
 * @property float $p_sale_price
 * @property int $p_offer
 * @property int $p_in_stock
 * @property int $p_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderProduct[] $orders
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product wherePActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product wherePBanner($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product wherePCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product wherePDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product wherePInStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product wherePName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product wherePOffer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product wherePPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product wherePSalePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product wherePSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    protected $guarded =[];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function subImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product)
        {
            $product->p_slug = str_slug($product->p_name);
        });
    }

    public function saveNewProductInfo($request, $product, $imageURL)
    {
        $product->category_id = $request->category_id;
        $product->p_name = $request->p_name;
        $product->p_code = $request->p_code;
        $product->p_description = $request->p_description;
        $product->p_price = $request->p_price;
        $product->p_offer = $request->p_offer;
        $product->p_sale_price = (($request->p_price)-(($request->p_price * $request->p_offer) / 100));
        $product->p_in_stock = $request->p_in_stock;
        $product->p_active = $request->p_active;
        $product->p_banner = $imageURL;

        $product->save();

        return $product;
    }
}
