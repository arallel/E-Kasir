<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class potonganRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // public function authorize()
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id_barang' => 'required',
            'nama_potongan' => 'required',
            'harga_potongan' => 'required|integer',
            'tgl_awal_potongan' => 'required|date',
            'tgl_akhir_potongan' => 'required|date',
            'harga_setelah_potongan' => 'required|integer',
        ];
    }
}
