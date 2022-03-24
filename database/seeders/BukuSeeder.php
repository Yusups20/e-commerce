<?php

namespace Database\Seeders;

use App\Models\Buku;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Buku::create([
            'judul' => 'One Piece',
            'slug' => Str::slug('one piece'),
            'berkas_sampul' => 'op.jpeg',
            'id_penulis' => 1,
            'id_penerbit' => 1,
            'id_kategori' => 1,
        ]);

        Buku::create([
            'judul' => 'Boruto',
            'slug' => Str::slug('boruto'),
            'berkas_sampul' => 'boruto.jpeg',
            'id_penulis' => 1,
            'id_penerbit' => 1,
            'id_kategori' => 1,
        ]);
    }
}
