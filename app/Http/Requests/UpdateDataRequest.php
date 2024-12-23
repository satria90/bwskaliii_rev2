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
            'fileDataRequest' => ['nullable', 'file', 'mimes:pdf,docx,doc,jpg,jpeg,png,zip'], // File upload
            // 'fileDataPerizinan' => ['nullable', 'file', 'mimes:pdf,docx,doc,jpg,jpeg,png,zip'], // File upload
            // 'fileDataRekomtek' => ['nullable', 'file', 'mimes:pdf,docx,doc,jpg,jpeg,png,zip'], // File upload
            'fileDataSda' => ['nullable', 'file', 'mimes:pdf,docx,doc,jpg,jpeg,png,zip'], // File upload
            // 'fileDataPeminjaman' => ['nullable', 'file', 'mimes:pdf,docx,doc,jpg,jpeg,png,zip'], // File upload
            // 'fileDataPengaduan' => ['nullable', 'file', 'mimes:pdf,docx,doc,jpg,jpeg,png,zip'], // File upload
            // 'UnoperatedPermission' => ['nullable', 'boolean'],
            // 'OperatedPermission' => ['nullable', 'boolean'],
            // 'RiverDiversion' => ['nullable', 'boolean'],
            // 'WaterAvaiability' => ['nullable', 'boolean'],
            // 'MinerC' => ['nullable', 'boolean'],
            'RainFall' => ['nullable', 'boolean'],
            'WaterHeight' => ['nullable', 'boolean'],
            'Climatology' => ['nullable', 'boolean'],
            'WaterQuality' => ['nullable', 'boolean'],
            'WaterBalance' => ['nullable', 'boolean'],
            'RiverNetwork' => ['nullable', 'boolean'],
            'WaterDischarge' => ['nullable', 'boolean'],
            'WatershedMap' => ['nullable', 'boolean'],
            // 'Tools' => ['nullable', 'boolean'],
            // 'PumpsEquipment' => ['nullable', 'boolean'],
            // 'Information' => ['nullable', 'string'],
            'RequiredInformation' => ['nullable', 'string'],
            'ForResearch' => ['nullable', 'boolean'],
            'ForStudyProject' => ['nullable', 'boolean'],
            'otherPurpose' => ['nullable', 'string'],
            'Status' => ['nullable', 'string', 'max:255'],
            'is_Proof' => ['nullable', 'boolean'],
            'deadline' => ['nullable', 'date'],
        ];
    }
}
