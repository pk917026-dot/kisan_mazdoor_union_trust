<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('notification_settings', function (Blueprint $table) {
            $table->id();
            $table->string('channel'); // email, sms, whatsapp
            $table->boolean('enabled')->default(false);

            // Common fields:
            $table->string('sender_name')->nullable();
            $table->string('sender_id')->nullable();

            // Email (SMTP/API)
            $table->string('email_host')->nullable();
            $table->string('email_port')->nullable();
            $table->string('email_username')->nullable();
            $table->string('email_password')->nullable(); // store encrypted ideally
            $table->string('email_encryption')->nullable();

            // SMS
            $table->string('sms_api_url')->nullable();
            $table->string('sms_api_key')->nullable();
            $table->string('sms_sender')->nullable();

            // WhatsApp
            $table->string('wa_api_url')->nullable();
            $table->string('wa_api_key')->nullable();
            $table->string('wa_number')->nullable();

            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('notification_settings');
    }
};
