<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('member_field_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_registration_id');
            $table->unsignedBigInteger('form_field_id');
            $table->text('value')->nullable();
            $table->timestamps();

            $table->foreign('member_registration_id')
                  ->references('id')->on('member_registrations')
                  ->onDelete('cascade');

            $table->foreign('form_field_id')
                  ->references('id')->on('form_fields')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('member_field_values');
    }
};
