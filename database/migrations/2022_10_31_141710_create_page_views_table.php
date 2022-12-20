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
        Schema::create('page_views', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('page_index');
            $table->string("url");
            $table->string("session_id");
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string("ip");
            $table->string('browser', 50)->default('unknown');
            $table->string('country', 50)->default('unknown');
            $table->string('device', 50)->default('unknown');
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
        Schema::dropIfExists('page_views');
    }
};
