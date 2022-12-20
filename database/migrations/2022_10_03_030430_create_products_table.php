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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('slug')->unique();
            $table->longText('body')->nullable();
            $table->longText('docs')->nullable();
            $table->string('image')->nullable();

            $table->decimal('price_usd', 8, 2)->default(0);
            $table->string('price_idr', 10, 2)->default(0);
            $table->integer('discount_usd')->nullable();
            $table->integer('discount_idr')->nullable();

            $table->enum('product_type', ['free', 'pay'])->default('free');
            $table->enum('status', ['draft', 'published', 'archived'])->default('published');

            $table->bigInteger('author_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();

            $table->string('live_preview')->nullable();

            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('meta_thumbnail')->nullable();

            $table->softDeletes();
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
        Schema::dropIfExists('products');
    }
};
