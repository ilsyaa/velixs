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
        Schema::create('blog_views', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("blog_id");
            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
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
        Schema::dropIfExists('blog_views');
    }
};
