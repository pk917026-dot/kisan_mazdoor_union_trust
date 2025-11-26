<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('form_fields', function (Blueprint $table) {

            // नया कॉलम add करना:
            // हर field किस step में दिखेगा (1, 2, 3...)
            $table->integer('step_number')->default(1)->after('order');
        });
    }

    public function down()
    {
        Schema::table('form_fields', function (Blueprint $table) {
            $table->dropColumn('step_number');
        });
    }
};
