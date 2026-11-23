<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Tenda & Shelter' => 'Sewa tenda camping dan perlengkapan shelter untuk perjalanan alam terbuka di Bogor dan sekitarnya.',
            'Tas & Carrier' => 'Pilihan tas carrier hiking untuk membawa perlengkapan selama pendakian dan kegiatan outdoor.',
            'Perlengkapan Tidur' => 'Perlengkapan tidur camping untuk membantu istirahat lebih nyaman di alam terbuka.',
            'Peralatan Masak' => 'Peralatan masak portable untuk menyiapkan makanan selama camping dan aktivitas outdoor.',
            'Matras & Alas' => 'Matras dan alas camping yang praktis untuk menunjang kenyamanan saat beristirahat.',
            'Aksesori Hiking' => 'Aksesori hiking untuk mendukung perjalanan trekking dan pendakian.',
        ];

        $categoryRecords = [];
        foreach ($categories as $name => $description) {
            $categoryRecords[$name] = Category::firstOrCreate(
                ['name' => $name],
                ['description' => $description],
            );
        }

        /** @var list<array{
         *     category: string,
         *     name: string,
         *     description: string,
         *     price_per_day: int,
         *     stock: int,
         *     variants?: list<array{
         *         variant_name: string,
         *         sku: string,
         *         stock: int,
         *         price_per_day: int
         *     }>
         * }> $products
         */
        $products = [
            [
                'category' => 'Tenda & Shelter',
                'name' => 'Sewa Tenda Dome Camping',
                'description' => 'Tenda dome camping untuk perjalanan bersama teman atau keluarga, dengan pilihan kapasitas 2 dan 4 orang. Cocok untuk camping di Bogor dan area alam terbuka lainnya. Harga sewa dihitung per hari; pilih kapasitas dan cek stok sebelum memesan.',
                'price_per_day' => 35000,
                'stock' => 5,
                'variants' => [
                    [
                        'variant_name' => 'Kapasitas 2 Orang',
                        'sku' => 'CAMP-TEN-DOME-2P',
                        'stock' => 2,
                        'price_per_day' => 35000,
                    ],
                    [
                        'variant_name' => 'Kapasitas 4 Orang',
                        'sku' => 'CAMP-TEN-DOME-4P',
                        'stock' => 3,
                        'price_per_day' => 45000,
                    ],
                ],
            ],
            [
                'category' => 'Tas & Carrier',
                'name' => 'Sewa Carrier Hiking 45 Liter',
                'description' => 'Carrier hiking 45 liter untuk membawa perlengkapan pribadi saat trekking atau pendakian singkat. Kapasitasnya cocok untuk perjalanan outdoor beberapa hari, bergantung pada kebutuhan dan cara mengemas barang. Tersedia untuk sewa harian di Bogor.',
                'price_per_day' => 30000,
                'stock' => 4,
            ],
            [
                'category' => 'Tas & Carrier',
                'name' => 'Sewa Carrier Hiking 60 Liter',
                'description' => 'Carrier hiking 60 liter untuk pendaki yang membutuhkan ruang lebih untuk membawa perlengkapan perjalanan. Cocok untuk camping dan pendakian dengan bawaan lebih banyak. Cek ketersediaan stok sebelum memilih tanggal sewa.',
                'price_per_day' => 35000,
                'stock' => 3,
            ],
            [
                'category' => 'Perlengkapan Tidur',
                'name' => 'Sewa Sleeping Bag Camping',
                'description' => 'Sleeping bag camping untuk menemani waktu istirahat saat bermalam di alam terbuka. Pilihan praktis bagi pendaki dan peserta camping yang ingin mengurangi barang bawaan. Harga sewa dihitung per hari dan ketersediaan dapat berubah.',
                'price_per_day' => 15000,
                'stock' => 6,
            ],
            [
                'category' => 'Matras & Alas',
                'name' => 'Sewa Matras Camping Lipat',
                'description' => 'Matras camping lipat sebagai alas istirahat yang mudah dibawa saat camping atau perjalanan outdoor. Gunakan bersama sleeping bag untuk menyiapkan area tidur di tenda. Tersedia untuk penyewaan harian di Bogor.',
                'price_per_day' => 10000,
                'stock' => 8,
            ],
            [
                'category' => 'Peralatan Masak',
                'name' => 'Sewa Kompor Portable Camping',
                'description' => 'Kompor portable camping untuk membantu menyiapkan makanan dan minuman selama kegiatan outdoor. Periksa perlengkapan dan kebutuhan bahan bakar sebelum berangkat. Sewa harian, dengan stok mengikuti ketersediaan.',
                'price_per_day' => 15000,
                'stock' => 5,
            ],
            [
                'category' => 'Aksesori Hiking',
                'name' => 'Sewa Tongkat Trekking Adjustable',
                'description' => 'Tongkat trekking adjustable untuk membantu menjaga keseimbangan saat berjalan di jalur hiking. Praktis dibawa untuk trekking dan pendakian sesuai kondisi rute. Tanyakan ketersediaan sebelum melakukan pemesanan.',
                'price_per_day' => 10000,
                'stock' => 6,
            ],
        ];

        foreach ($products as $productData) {
            $product = Product::firstOrCreate(
                ['name' => $productData['name']],
                [
                    'category_id' => $categoryRecords[$productData['category']]->id,
                    'image' => '',
                    'description' => $productData['description'],
                    'price_per_day' => $productData['price_per_day'],
                    'stock' => $productData['stock'],
                    'condition' => 'baik',
                ],
            );

            foreach ($productData['variants'] ?? [] as $variantData) {
                $product->variants()->firstOrCreate(
                    ['sku' => $variantData['sku']],
                    [
                        'variant_name' => $variantData['variant_name'],
                        'stock' => $variantData['stock'],
                        'price_per_day' => $variantData['price_per_day'],
                    ],
                );
            }
        }
    }
}
