<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('image');  // photo path
            $table->string('title')->nullable(); // optional caption
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('galleries');
    }
};
