<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApprovalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasAnyRole(['owner', 'client', 'admin']);
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
            'idNumber' => ['required','string','max:16'],
            'proof'=>['required','image','mimes:png,jpg,jpeg'],
            'fullName' => ['required','string','max:255'],
            'homeAddress' => ['required','string','max:255'],
            'occupation' => ['required','string','max:255'],
            'companyName' => ['required','string','max:255'],
            'companyAddress' => ['required','string','max:255'],
            'adminApproval' => ['required','image','mimes:png,jpg,jpeg'],
        ];
    }
}
