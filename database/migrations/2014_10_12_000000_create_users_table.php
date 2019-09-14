<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->integer('role')->default(2);

            $table->string('email', 80)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('email_verification_token', 80)->nullable();

            $table->string('phone_number', 50)->unique();
            $table->string('password', 128);
            $table->bigInteger('reward_point')->default(0);
            $table->string('facebook_id', 30)->nullable();
            $table->string('gmail_id', 30)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
