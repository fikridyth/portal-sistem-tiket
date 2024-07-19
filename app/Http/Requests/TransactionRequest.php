<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id_ticket' => 'required',
            'jumlah' => 'required',
            'nama' => 'required',
            'email' => 'required|email',
            'telepon' => 'required',
        ];
    }

    public function attributes(): array
    {
        return [
            'id_ticket' => 'Ticket',
            'jumlah' => 'Jumlah',
            'nama' => 'Nama',
            'email' => 'Email',
            'telepon' => 'No Telepon',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute Field Is Required'
        ];
    }
}
