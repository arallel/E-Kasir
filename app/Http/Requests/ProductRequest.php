<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class ProductRequest extends FormRequest
{
    public function rules($id = null)
    {
        return [
            'nama_barang' => 'required|string|max:255',
            'foto_barang' => 'image|max:10240|mimes:jpg,jpeg,png,svg',
            'stok' => 'required|min:1|numeric',
            'id_kategory' => 'required|numeric',
            'harga_barang' => 'min_digits:1|numeric|required',
            'harga_pembelian' => 'min_digits:1|numeric|required',
             
        ];
    }
   public function messages()
   {
     return [
        'nama_barang.required' => 'Nama barang harus diisi.',
        'nama_barang.string' => 'Nama barang harus berupa teks.',
        'nama_barang.max' => 'Nama barang tidak boleh lebih dari 255 karakter.',
        'foto_barang.image' => 'Foto barang harus berupa gambar.',
        'foto_barang.max' => 'Ukuran foto barang tidak boleh lebih dari 10MB.',
        'foto_barang.mimes' => 'Format foto barang harus JPG, JPEG, PNG, atau SVG.',
        'stok.required' => 'Stok harus diisi.',
        'stok.min' => 'Stok minimal harus 1.',
        'stok.numeric' => 'Stok harus berupa angka.',
        'id_kategory.required' => 'Harus Memilih Kategory',
        'harga_barang.min_digits' => 'Harga barang minimal harus 1 digit.',
        'harga_barang.numeric' => 'Harga barang harus berupa angka.',
        'harga_barang.required' => 'Harga barang harus diisi.',
        'harga_pembelian.min_digits' => 'Harga pembelian minimal harus 1 digit.',
        'harga_pembelian.numeric' => 'Harga pembelian harus berupa angka.',
        'harga_pembelian.required' => 'Harga pembelian harus diisi.',
        'barcode.required' => 'Kode barcode harus diisi.',
        'barcode.unique' => 'Kode barcode sudah digunakan.',
     ];
    }
}

