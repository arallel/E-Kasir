<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
             'nama_barang' => 'required|string|max:255',
            'foto_barang' => 'image|max:10240',
            'stok' => 'required|min:1',
            'id_kategory' => 'required',
            'barcode' => 'required|string|max:255|unique:databarang,barcode',
        ];
    }
    
    public function messages()
    {
    return [
        'nama_barang.required' => 'Nama barang harus diisi',
        'foto_barang.required' => 'Foto barang harus diunggah',
        'stok.required' => 'Stok harus diisi',
        'stok.min' => 'Stok Minimal 1',
        'id_kategory.required' => 'Kategori barang harus dipilih',
        'id_kategory.required' => 'Kategori barang tidak valid',
        'id_kategory.exists' => 'Kategori barang tidak valid',
        'status_barang.required' => 'Status barang harus dipilih',
        // 'barcode.required' => 'Barcode harus diisi',
        // 'barcode.unique' => 'Barcode sudah digunakan',
    ];
     }
}

