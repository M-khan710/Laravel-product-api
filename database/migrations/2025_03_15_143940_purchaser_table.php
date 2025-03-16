<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('Purchasers', function (Blueprint $table) {
            $table->id();
            
            $table->string('name'); 
            $table->string('email');
            $table->text('shipping_address'); 
            $table->integer('product_id');
            $table->text('product_name');
            $table->integer('payments'); 
            $table->string('payment_status');
            $table->string('payment_mode');
            $table->integer('quantity');
            $table->string('status'); 
            $table->string('purchaser_uuid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('Purchasers');

    }
};
