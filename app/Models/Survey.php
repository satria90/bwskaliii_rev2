<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Survey extends Model
{
    //
    use HasFactory, SoftDeletes;

    protected $fillable =[
        'question1',
        'question2',
        'question3',
        'question4',
        'question5',
        'question6',
        'question7',
        'question8',
        'question9',
        'question10',
        'advice'
    ];


    public function dataRequest()
    {
        return $this->belongsToMany(Survey::class, 'data_request');
    }
    
}
