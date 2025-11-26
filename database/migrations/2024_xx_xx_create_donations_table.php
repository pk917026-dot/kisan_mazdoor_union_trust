<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up() {

        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->string('receipt_no')->unique();
            $table->string('name')->nullable();
            $table->string('mobile')->nullable();
            $table->string('amount')->nullable();
            $table->boolean('anonymous')->default(0); // Hide name option
            $table->string('payment_mode')->nullable(); // UPI / Cash / Bank
            $table->string('transaction_id')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('donations');
    }
};
