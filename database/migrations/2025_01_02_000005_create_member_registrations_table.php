<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('member_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('member_code')->unique()->nullable();
            $table->string('name');               // basic field
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('status')->default('pending'); // pending/approved/rejected
            $table->date('approved_at')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable(); // admin id
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('member_registrations');
    }
};
