<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User;
use Spatie\Permission\Traits\HasRoles;

class DataRequest extends Model
{
    use HasFactory, SoftDeletes, HasRoles;

    protected $fillable = [
        'user_id',
        'survey_id',
        'fileDataRequest',
        // 'fileDataPerizinan',
        // 'fileDataRekomtek',
        'fileDataSda',
        // 'fileDataPeminjaman',
        // 'fileDataPengaduan',
        // 'UnoperatedPermission',
        // 'OperatedPermission',
        // 'RiverDiversion',
        // 'WaterAvailability',
        // 'MinerC',
        'RainFall',
        'WaterHeight',
        'Climatology',
        'WaterQuality',
        'WaterBalance',
        'RiverNetwork',
        'WaterDischarge',
        'WatershedMap',
        // 'Tools',
        // 'PumpsEquipment',
        // 'Information',
        'requiredInformation',
        'ForResearch',
        'ForStudyProject',
        'otherPurpose',
        'Status',
        'is_Proof',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function survey()
    {
        return $this->belongsTo(Survey::class, 'survey_id');
    }
}
