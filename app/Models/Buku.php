<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';
    protected $fillable = ['judul', 'slug', 'id_kategori', 'id_penerbit', 'id_penulis', 'berkas_sampul'];

    public static function findOrFail($params = [])
    {
        if (is_array($params)) {
            $query = Buku::query($params);
        } else {
            $query = Buku::where('id', '=', $params);
        }

        $model = $query->first();

        if ($model === null) {
            abort(403, "Data not found");
        }

        return $model;
    }

    public function kategori()
    {
        return $this->hasOne(Kategori::class, 'id', 'id_kategori');
    }

    public function penerbit()
    {
        return $this->hasOne(Penerbit::class, 'id', 'id_penerbit');
    }

    public function penulis()
    {
        return $this->hasOne(Penulis::class, 'id', 'id_penulis');
    }
}
