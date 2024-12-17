<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SurveyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasAnyRole(['owner', 'admin', 'client']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'question1'=>['required'],
            'question2'=>['required'],
            'question3'=>['required'],
            'question4'=>['required'],
            'question5'=>['required'],
            'question6'=>['required'],
            'question7'=>['required'],
            'question8'=>['required'],
            'question9'=>['required'],
            'question10'=>['required'],
            'advice'=>['required', 'string', 'max:255'],

        ];
    }
}
