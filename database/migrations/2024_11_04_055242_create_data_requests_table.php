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
        Schema::create('data_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('survey_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('Rainfall')->nullable();
            $table->string('RiverProfile')->nullable();
            $table->string('Topography')->nullable();
            $table->string('StudyResearch')->nullable();
            $table->string('WaterAllocation')->nullable();
            $table->string('otherCheckbox');
            $table->string('requiredInformation');
            $table->string('ForResearch')->nullable();
            $table->string('ForStudyProject')->nullable();
            $table->string('otherPurpose');
            $table->string('Status')->nullable();
            $table->string('fileDataRequest')->nullable();
            $table->boolean('is_Proof')->nullable();
            $table->softDeletes();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_requests');
    }
};
