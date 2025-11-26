<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('form_fields', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('name')->unique();             // DB key
            $table->string('type')->default('text');      // text, textarea, select, date...
            $table->boolean('is_required')->default(true);
            $table->integer('sort_order')->default(0);
            $table->json('options')->nullable();          // dropdown options
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('form_fields');
    }
};
