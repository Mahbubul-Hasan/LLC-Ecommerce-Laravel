<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("user_id");

            $table->string("o_customer_name", 50);
            $table->string("o_customer_phone_number", 20);
            $table->text("o_address");

            $table->decimal("o_total_price", 10, 2);
            $table->decimal("o_discount_price", 10, 2)->default(0.00);
            $table->decimal("o_paid_price", 10, 2);

            $table->string("o_payment_method", 25)->nullable();
            $table->string("o_payment_status", 15)->default("Pending");

            $table->string("o_operational_status", 15)->default("Pending");

            $table->unsignedInteger("o_processed_by")->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('o_processed_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
