<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('form_fields', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('form_id');
            $table->string('label');          // e.g. "Full Name"
            $table->string('name');           // e.g. "full_name" (input name)
            $table->string('type');           // text, email, number, textarea, select, radio, checkbox, date, file
            $table->boolean('is_required')->default(false);
            $table->text('options')->nullable(); // JSON for select/radio/checkbox
            $table->string('validation_rules')->nullable(); // e.g. "required|email|max:255"
            $table->integer('order')->default(0); // ordering in form
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('form_id')->references('id')->on('forms')->onDelete('cascade');
        });
    }

    public function down() {
        Schema::dropIfExists('form_fields');
    }
};
