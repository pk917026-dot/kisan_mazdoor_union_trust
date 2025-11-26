<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('trust_name')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('header_color')->default('#1a56db');
            $table->string('footer_color')->default('#0f172a');
            $table->string('menu_color')->default('#1e293b');
            $table->string('theme_color')->default('#1d4ed8');
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('footer_text')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('settings');
    }
};
