<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
        if (request()->routeIs('master.event.store')) {
            return [
                'nama' => 'required',
                'kategori' => 'required',
                'lokasi' => 'required',
                'provinsi' => 'required',
                'deskripsi' => 'required',
                'informasi' => 'required',
                'tanggal_mulai' => 'required',
                'tanggal_selesai' => 'required',
                'gambar' => 'required|max:2048|mimes:jpeg,jpg,png',
            ];
        } else {
            return [
                'nama' => 'required',
                'kategori' => 'required',
                'lokasi' => 'required',
                'provinsi' => 'required',
                'deskripsi' => 'required',
                'informasi' => 'required',
                'tanggal_mulai' => 'required',
                'tanggal_selesai' => 'required',
            ];
        }
    }

    public function attributes(): array
    {
        return [
            'nama' => 'Nama',
            'kategori' => 'Kategori',
            'lokasi' => 'Lokasi',
            'provinsi' => 'Provinsi',
            'deskripsi' => 'Deskripsi',
            'informasi' => 'Informasi',
            'tanggal_mulai' => 'Tanggal Mulai',
            'tanggal_selesai' => 'Tanggal Selesai',
            'gambar' => 'Gambar',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute Harus Diisi',
            'max' => ':attribute Tidak Boleh Lebih Dari 2 MB',
            'mimes' => ':attribute Hanya Boleh Format JPG dan PNG'
        ];
    }
}
