<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BukuapiController extends Controller
{
    public function index()
    {
        $buku = Buku::latest()->get();
        return response([
            'succes'  => true,
            'message' => 'List Semua Buku',
            'data'    => $buku 
        ], 200);
    }

    public function store(Request $request)
    {
        //validasi data
        $validator = Validator::make($request->all(),[
            'judul'       => 'required',
            'slug'        => 'required',
            'id_kategori' => 'required',
            'id_penerbit' => 'required',
            'id_penulis'  => 'required',
        ],
            [
                'judul.required'       => 'masukan judul buku',
                'slug.required'        => 'masukan slug',
                'id_kategori.required' => 'masukan kategori buku',
                'id_penerbit.required' => 'masukan penerbit buku',
                'id_penulis.required'  => 'masukan penulis buku',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'succses' => false,
                'message' => 'Silahkan isi bidang yang kosong',
                'data'    => $validator->errors()
            ], 401);
        }else {
            $buku = Buku::create([
                'judul'       => $request->input('judul'),
                'slug'        => $request->input('slug'),
                'id_kategori' => $request->input('id_kategori'),
                'id_penerbit' => $request->input('id_penerbit'),
                'id_penulis'  => $request->input('id_penulis'),
            ]);
            if ($buku) {
                return response()->json([
                    'succes'  => true,
                    'message' => 'Data buku berhasil di simpan',  
                ], 200);
            }else {
                return response()->json([
                    'succes'  => false,
                    'message' => 'Data buku gagal di simpan',
                ], 401);
            }
        }
    }

    public function update(Request $request)
    {
        //validasi data
        $validator = Validator::make($request->all(),[
            'judul'       => 'required',
            'slug'        => 'required',
            'id_kategori' => 'required',
            'id_penerbit' => 'required',
            'id_penulis'  => 'required',
        ],
            [
                'judul.required'       => 'masukan judul buku',
                'slug.required'        => 'masukan slug',
                'id_kategori.required' => 'masukan kategori buku',
                'id_penerbit.required' => 'masukan penerbit buku',
                'id_penulis.required'  => 'masukan penulis buku',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success'  => false,
                'message' => 'silahkan isi bidang yang kosong',
                'data'    => $validator->errors()
            ],401);
        }else {
            $buku = Buku::whereId($request->input('id'))->update([
                'judul'       => $request->input('judul'),
                'slug'        => $request->input('slug'),
                'id_kategori' => $request->input('id_kategori'),
                'id_penerbit' => $request->input('id_penerbit'),
                'id_penulis'  => $request->input('id_penulis'),
            ]);
            if ($buku) {
                return response()->json([
                    'success'  => true,
                    'message' => 'Data buku berhasil di update!',
                ], 200);
            }else {
                return response()->json([
                    'success'  => false,
                    'message' => 'Data buku gagal di update!'
                ], 401);
            }
        }
    }

    public function show($id)
    {
        $buku = Buku::whereId($id)->first();

        if ($buku) {
            return response()->json([
                'success' => true,
                'message' => 'Detail buku!',
                'data'    => $buku
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data buku Tidak Ditemukan!',
                'data'    => ''
            ], 401);
        }
    }

    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();

        if ($buku) {
            return response()->json([
                'success' => true,
                'message' => 'Data Buku Berhasil Dihapus!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data Buku Gagal Dihapus!',
            ], 400);
        }
    }
}
