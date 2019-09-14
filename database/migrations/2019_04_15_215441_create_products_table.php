<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('category_id');
            $table->string('p_name', 80)->unique();
            $table->string('p_slug', 80)->unique();
            $table->string('p_code', 80)->unique();
            $table->text('p_banner');
            $table->text('p_description');
            $table->decimal('p_price', 10,2);
            $table->decimal('p_sale_price', 10,2)->default(0.00);
            $table->integer('p_offer')->default(0);
            $table->tinyInteger('p_in_stock')->default(1);
            $table->tinyInteger('p_active')->default(1);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
