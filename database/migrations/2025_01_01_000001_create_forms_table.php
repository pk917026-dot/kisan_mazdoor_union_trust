<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('forms', function (Blueprint $table) {
            $table->id();
            $table->string('name');          // e.g. "Registration Form"
            $table->string('slug')->unique(); // e.g. "registration"
            $table->string('title')->nullable(); // Heading on public page
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('forms');
    }
};
