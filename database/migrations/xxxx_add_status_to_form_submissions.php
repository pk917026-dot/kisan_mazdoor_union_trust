<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('form_submissions', function (Blueprint $table) {
            $table->string('status')->default('pending');
            $table->text('admin_remarks')->nullable();
        });
    }

    public function down() {
        Schema::table('form_submissions', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('admin_remarks');
        });
    }
};
