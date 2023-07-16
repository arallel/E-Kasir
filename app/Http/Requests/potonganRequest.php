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
            'harga_awal' => 'required|numeric',
            'harga_potongan_rp' => 'numeric|nullable',
            'harga_potongan_persen' => 'numeric|nullable',
            'tgl_awal_potongan' => 'required|date',
            'tgl_akhir_potongan' => 'required|date',
            'harga_setelah_potongan' => 'required|numeric',
        ];
    }
    public function messages()
    {
    return [
        'id_barang.required' => 'Kolom ID Barang harus diisi.',
        'harga_awal.required' => 'Kolom Harga Awal harus diisi.',
        'harga_awal.numeric' => 'Kolom Harga Awal harus berupa angka.',
        'harga_potongan_rp.numeric' => 'Kolom Harga Potongan dalam Rupiah harus berupa angka.',
        'harga_potongan_persen.numeric' => 'Kolom Harga Potongan dalam Persen harus berupa angka.',
        'tgl_awal_potongan.required' => 'Kolom Tanggal Awal Potongan harus diisi.',
        'tgl_awal_potongan.date' => 'Kolom Tanggal Awal Potongan harus dalam format tanggal yang valid.',
        'tgl_akhir_potongan.required' => 'Kolom Tanggal Akhir Potongan harus diisi.',
        'tgl_akhir_potongan.date' => 'Kolom Tanggal Akhir Potongan harus dalam format tanggal yang valid.',
        'harga_setelah_potongan.required' => 'Kolom Harga Setelah Potongan harus diisi.',
        'harga_setelah_potongan.numeric' => 'Kolom Harga Setelah Potongan harus berupa angka.',
    ];
    }
}
