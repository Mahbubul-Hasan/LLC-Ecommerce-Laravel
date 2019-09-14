<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $c_name
 * @property string $c_slug
 * @property string|null $c_banner
 * @property int $c_active
 * @property int|null $category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $child_category
 * @property-read \App\Models\Category $parents_category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereCActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereCBanner($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereCName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereCSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Category extends Model
{
    protected $guarded = [];

    public function parents_category()
    {
        return $this->belongsTo(Category::class);
    }

    public function child_category()
    {
        return $this->hasMany(Category::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category)
        {
            $category->c_slug = str_slug($category->c_name);
        });
    }

    public function newCategorySave($request, $category, $imageURL)
    {
        $category->c_name   = $request->c_name;
        $category->c_active = $request->c_active;
        $category->c_banner = $imageURL;

        $category->save();
    }
}
