<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property int $user_id
 * @property string $o_customer_name
 * @property string $o_customer_phone_number
 * @property string $o_address
 * @property string $o_city
 * @property string $o_postal_code
 * @property float $o_total_price
 * @property float $o_discount_price
 * @property float $o_paid_price
 * @property string|null $o_payment_method
 * @property string $o_payment_status
 * @property string $o_operational_status
 * @property int|null $o_processed_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $Processor
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderProduct[] $products
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOCustomerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOCustomerPhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereODiscountPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOOperationalStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOPaidPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOPaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOPaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOPostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOProcessedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereUserId($value)
 * @mixin \Eloquent
 */
class Order extends Model
{
    protected $guarded =[];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function Processor()
    {
        return $this->hasOne(User::class, "processed_by");
    }

    public function products()
    {
        return $this->hasMany(OrderProduct::class);
    }


    public function newOrderSave($request, $order)
    {
        $order->user_id                 = auth()->user()->id;
        $order->o_customer_name         = $request->o_customer_name;
        $order->o_customer_phone_number = $request->o_customer_phone_number;
        $order->o_address               = $request->o_address;
        $order->o_total_price           = session("total_price");
        $order->o_paid_price            = session("total_price");
        $order->o_payment_method        = $request->o_payment_method;

        $order->save();

        return $order;
    }
}
