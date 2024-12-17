<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDataRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasAnyRole(['owner', 'admin']);
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
                'Rainfall' => ['nullable', 'string'],
                'RiverProfile' => ['nullable', 'string'],
                'Topography' => ['nullable', 'string'],
                'StudyResearch' => ['nullable', 'string'],
                'WaterAllocation' => ['nullable', 'string'],
                'otherCheckbox' => ['nullable', 'string'],
                'requiredInformation' => ['nullable', 'string'],
                'ForResearch' => ['nullable', 'boolean'],
                'ForStudyProject' => ['nullable', 'boolean'],
                'otherPurpose' => ['nullable', 'string'],
                'Status' => ['nullable', 'string', 'max:255'],
                'fileDataRequest' => ['nullable', 'file', 'mimes:pdf,docx,doc,jpg,jpeg,png,zip'],
                'is_Proof' => ['nullable', 'boolean'],
                'deadline' => ['nullable', 'date'],

        ];
    }
}
