<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up() {

        Schema::create('incomes', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('category_id');
            $table->string('title');
            $table->string('amount');
            $table->date('date');
            $table->string('receipt_no')->nullable();

            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('income_categories')->onDelete('cascade');
        });
    }

    public function down() {
        Schema::dropIfExists('incomes');
    }
};
