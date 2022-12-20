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
        Schema::create('web_masters', function (Blueprint $table) {
            $table->id();
            $table->string('whatsapp_bot')->nullable();
            $table->string('payment_whatsapp')->nullable();
            $table->text('payment_whatsapp_message')->nullable();
            $table->enum('paypal_status', ['active', 'inactive'])->default('active');
            $table->enum('paypal_mode', ['sandbox', 'live'])->default('sandbox');
            $table->string('paypal_sandbox_client_id')->nullable();
            $table->string('paypal_sandbox_client_secret')->nullable();
            $table->string('paypal_live_client_id')->nullable();
            $table->string('paypal_live_client_secret')->nullable();
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
        Schema::dropIfExists('web_masters');
    }
};
