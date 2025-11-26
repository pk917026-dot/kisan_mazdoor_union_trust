<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('title');                 // Menu name
            $table->string('url')->nullable();       // External / Internal link
            $table->integer('parent_id')->default(0); // For dropdown menu
            $table->integer('order')->default(0);     // For menu sorting
            $table->boolean('status')->default(1);    // Show / Hide
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('menus');
    }
};
