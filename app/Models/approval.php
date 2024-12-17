<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class approval extends Model
{
    //
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'proof',
        'upload',
        'idNumber',
        'approval_start_date'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
