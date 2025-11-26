<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('homepage_settings', function (Blueprint $table) {
            $table->id();
            $table->string('welcome_title')->nullable();
            $table->text('welcome_description')->nullable();
            $table->string('marquee_text')->nullable();
            $table->string('video_url')->nullable();
            $table->string('about_title')->nullable();
            $table->text('about_description')->nullable();
            $table->boolean('show_gallery')->default(true);
            $table->boolean('show_notice')->default(true);
            $table->boolean('show_video')->default(true);
            $table->boolean('show_about')->default(true);
            $table->boolean('show_slider')->default(true);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('homepage_settings');
    }
};
