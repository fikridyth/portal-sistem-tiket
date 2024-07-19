<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
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
            'id_event' => 'required',
            'nama' => 'required',
            'harga' => 'required',
            'kuota' => 'required'
        ];
    }

    public function attributes(): array
    {
        return [
            'id_event' => 'Event',
            'nama' => 'Nama',
            'harga' => 'Harga',
            'kuota' => 'Kuota'
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute Harus Diisi',
        ];
    }
}
