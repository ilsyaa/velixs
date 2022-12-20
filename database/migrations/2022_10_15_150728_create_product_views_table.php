<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_views', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid("product_id");
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->string("url");
            $table->string("session_id");
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string("ip");
            $table->string('browser', 50)->default('Unknown');
            $table->string('country', 50)->default('Unknown');
            $table->string('device', 50)->default('Unknown');
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
        Schema::dropIfExists('product_views');
    }
};
