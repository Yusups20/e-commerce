<?php

namespace Database\Seeders;

use App\Models\Penulis;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class PenulisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $penulis = ['Yusup', 'Ihsan'];

        foreach ($penulis as $value) {
            Penulis::create([
                'nama' => $value,
                'slug' => Str::slug($value)
            ]);
        }
    }
}
