<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {

        Schema::create('members', function (Blueprint $table) {
            $table->id();

            $table->string('membership_id')->unique();
            $table->string('name');
            $table->string('father_name')->nullable();
            $table->string('mobile')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('email')->nullable();
            $table->string('dob')->nullable();

            $table->string('address')->nullable();
            $table->string('district')->nullable();
            $table->string('state')->nullable();
            $table->string('pincode')->nullable();

            $table->string('photo')->nullable();

            $table->string('aadhaar')->nullable();
            $table->string('pan')->nullable();

            $table->boolean('status')->default(1);

            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('members');
    }
};
