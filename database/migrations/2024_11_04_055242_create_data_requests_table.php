<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('data_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('survey_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('fileDataRequest')->nullable();
            $table->string('fileDataPerizinan')->nullable();
            $table->string('fileDataRekomtek')->nullable();
            $table->string('fileDataSda')->nullable();
            $table->string('fileDataPeminjaman')->nullable();
            $table->string('fileDataPengaduan')->nullable();
            $table->string('UnoperatedPermission')->nullable();
            $table->string('OperationPermission')->nullable();
            $table->string('RiverDiversion')->nullable();
            $table->string('WaterAvailability')->nullable();
            $table->string('MinerC')->nullable();
            $table->string('RainFall')->nullable();
            $table->string('WaterHeight')->nullable();
            $table->string('Climatology')->nullable();
            $table->string('WaterQuality')->nullable();
            $table->string('WaterBalance')->nullable();
            $table->string('RiverNetwork')->nullable();
            $table->string('WaterDischarge')->nullable();
            $table->string('WatershedMap')->nullable();
            $table->string('Tools')->nullable();
            $table->string('PumpsEquipment')->nullable();
            $table->text('Information')->nullable();
            $table->text('requiredInformation');
            $table->string('ForResearch')->nullable();
            $table->string('ForStudyProject')->nullable();
            $table->text('otherPurpose')->nullable();
            $table->string('Status')->nullable();
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
