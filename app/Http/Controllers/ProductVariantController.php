<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductVariantRequest;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductVariantController extends Controller
{
    public function index(Product $product)
    {
        $variants = $product->variants()->latest()->paginate(10);

        return view('variants.index', compact('product', 'variants'));
    }

    public function store(StoreProductVariantRequest $request, Product $product)
    {
        $data = $request->validated();

        $data['sku'] = $data['sku'] ?? $this->generateSku();

        $product->variants()->create($data);

        return redirect()->route('variants.index', $product)
            ->with('success', 'Varian produk berhasil ditambahkan.');
    }

    public function edit(Product $product, ProductVariant $variant)
    {
        abort_if($variant->product_id !== $product->id, 404);

        return view('variants.edit', compact('product', 'variant'));
    }

    public function update(Request $request, Product $product, ProductVariant $variant)
    {
        abort_if($variant->product_id !== $product->id, 404);

        $data = $request->validate([
            'variant_name' => 'required|string|max:100',
            'sku' => 'nullable|string|max:100|unique:product_variants,sku,'.$variant->id,
            'stock' => 'required|integer|min:0',
            'price_per_day' => 'required|numeric|min:0',
        ]);

        $data['sku'] = $data['sku'] ?? $this->generateSku();

        $variant->update($data);

        return redirect()->route('variants.index', $product)
            ->with('success', 'Varian produk berhasil diperbarui.');
    }

    private function generateSku(): string
    {
        do {
            $sku = 'TTP-'.strtoupper((string) Str::random(8));
        } while (ProductVariant::where('sku', $sku)->exists());

        return $sku;
    }

    public function destroy(Product $product, ProductVariant $variant)
    {
        abort_if($variant->product_id !== $product->id, 404);

        $variant->delete();

        return redirect()->route('variants.index', $product)
            ->with('success', 'Varian produk berhasil dihapus.');
    }
}
