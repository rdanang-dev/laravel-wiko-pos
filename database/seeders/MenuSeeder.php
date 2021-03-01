<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menulists = collect([
            ['nama' => 'Hot Green Tea Late', 'harga' => 12000],
            ['nama' => 'Hot Red Velvet', 'harga' => 12000],
            ['nama' => 'Hot Taro', 'harga' => 12000],
            ['nama' => 'Hot Espresso Single', 'harga' => 9000],
            ['nama' => 'Hot Espresso Double', 'harga' => 12000],
            ['nama' => 'Hot Americano', 'harga' => 10000],
            ['nama' => 'Hot Capucino', 'harga' => 12000],
            ['nama' => 'Hot Kopi Susu Aren', 'harga' => 16000],
            ['nama' => 'Hot Kopi Susu Pisang', 'harga' => 16000],
            ['nama' => 'Hot Kopi Susu Hazelnut', 'harga' => 16000],
            ['nama' => 'Hot Kopi Susu Caramel', 'harga' => 16000],
            ['nama' => 'Hot Kopi Susu Rum', 'harga' => 16000],
            ['nama' => 'Hot Kopi Susu Vanila', 'harga' => 16000],
            ['nama' => 'Hot Veo', 'harga' => 13000],
            ['nama' => 'Hot Japanese', 'harga' => 15000],
            ['nama' => 'Hot Vietnam Drip', 'harga' => 12000],
            ['nama' => 'Hot Kopi Plunger', 'harga' => 10000],
            ['nama' => 'Hot Tubruk', 'harga' => 8000],
            ['nama' => 'Hot Kopi Santuy', 'harga' => 5000],
            ['nama' => 'Hot Kopi Susan', 'harga' => 7000],
            ['nama' => 'Hot Teh Vanilla', 'harga' => 5000],
            ['nama' => 'Ice Green Tea Late', 'harga' => 12000],
            ['nama' => 'Ice Red Velvet', 'harga' => 12000],
            ['nama' => 'Ice Taro', 'harga' => 12000],
            ['nama' => 'Ice Espresso Single', 'harga' => 9000],
            ['nama' => 'Ice Espresso Double', 'harga' => 12000],
            ['nama' => 'Ice Americano', 'harga' => 12000],
            ['nama' => 'Ice Capucino', 'harga' => 14000],
            ['nama' => 'Ice Kopi Susu Aren', 'harga' => 16000],
            ['nama' => 'Ice Kopi Susu Pisang', 'harga' => 16000],
            ['nama' => 'Ice Kopi Susu Hazelnut', 'harga' => 16000],
            ['nama' => 'Ice Kopi Susu Caramel', 'harga' => 16000],
            ['nama' => 'Ice Kopi Susu Rum', 'harga' => 16000],
            ['nama' => 'Ice Kopi Susu Vanila', 'harga' => 16000],
            ['nama' => 'Ice Veo', 'harga' => 13000],
            ['nama' => 'Ice Japanese', 'harga' => 15000],
            ['nama' => 'Ice Vietnam Drip', 'harga' => 14000],
            ['nama' => 'Ice Kopi Plunger', 'harga' => 10000],
            ['nama' => 'Ice Tubruk', 'harga' => 8000],
            ['nama' => 'Ice Kopi Santuy', 'harga' => 5000],
            ['nama' => 'Ice Kopi Susan', 'harga' => 7000],
            ['nama' => 'Ice Teh Vanilla', 'harga' => 5000],
            ['nama' => 'Air Mineral', 'harga' => 5000],
            ['nama' => 'Roti Bakar Coklat Keju', 'harga' => 10000],
            ['nama' => 'Roti Bakar Kacang Keju', 'harga' => 10000],
            ['nama' => 'Roti Bakar Stroberi Keju', 'harga' => 10000],
            ['nama' => 'Roti Bakar Nanas Keju', 'harga' => 10000],
            ['nama' => 'Roti Bakar Mix 2 Rasa', 'harga' => 10000],
            ['nama' => 'Kentang Goreng', 'harga' => 12000],
            ['nama' => 'Otak-Otak Goreng', 'harga' => 12000],
            ['nama' => 'Ketan Susu Coklat Keju', 'harga' => 10000],
            ['nama' => 'Indomie Rebus Telor', 'harga' => 10000],
            ['nama' => 'Indomie Goreng Telor', 'harga' => 10000],
        ]);

        $menulists->each(function ($menulist) {
            Menu::create([
                'nama' => $menulist["nama"],
                'slug' => Str::slug($menulist["nama"]),
                'harga' => $menulist["harga"]
            ]);
        });
    }
}
