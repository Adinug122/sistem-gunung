<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Override;

class StoreProductVariantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'variant_name' => 'required|string|max:100',
            'sku' => 'nullable|string|max:100|unique:product_variants,sku',
            'stock' => 'required|integer|min:0',
            'price_per_day' => 'required|numeric|min:0',
        ];
    }

    #[Override]
    public function messages()
    {
        return [
            'variant_name.required' => 'Nama varian wajib diisi.',
            'variant_name.max' => 'Nama varian maksimal 100 karakter.',
            'sku.unique' => 'SKU sudah digunakan oleh varian lain.',
            'stock.required' => 'Stok varian wajib diisi.',
            'stock.integer' => 'Stok harus berupa bilangan bulat.',
            'price_per_day.required' => 'Harga sewa per hari wajib diisi.',
            'price_per_day.numeric' => 'Harga harus berupa angka.',
        ];
    }
}
