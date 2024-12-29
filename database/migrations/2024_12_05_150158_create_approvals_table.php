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
        Schema::create('approvals', function (Blueprint $table) {
            $table->id();
            $table->string('fullName')->nullable();
            $table->string('homeAddress')->nullable();
            $table->string('occupation')->nullable();
            $table->string('companyName')->nullable();
            $table->string('companyAddress')->nullable();
            $table->boolean('upload')->nullable();
            $table->string('proof');
            $table->string('idNumber')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('approval_start_date')->nullable();
            $table->string('adminApproval')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approvals');
    }
};
