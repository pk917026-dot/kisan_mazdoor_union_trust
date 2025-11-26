<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('claims', function (Blueprint $table) {
            $table->id();
            
            // जिस member ने claim किया
            $table->unsignedBigInteger('member_id')->nullable();
            
            // claim type (death, disability etc.)
            $table->string('claim_type')->nullable();
            
            // claim amount
            $table->decimal('amount', 12, 2)->nullable();

            // status: pending, approved, rejected
            $table->string('status')->default('pending');

            // कोई reference number / policy / scheme id
            $table->string('reference_no')->nullable();

            // claim की date
            $table->date('claim_date')->nullable();

            // extra details
            $table->text('remarks')->nullable();

            $table->timestamps();

            // अगर बाद में members table से relation जोड़ना हो तो:
            // $table->foreign('member_id')->references('id')->on('members')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('claims');
    }
};
