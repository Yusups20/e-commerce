<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Penulis;
use App\Models\Penerbit;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $buku = Buku::where('judul', 'like', '%' . $search . '%')->latest()->paginate(5);

        return view('admin.buku.index', compact('buku'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.buku.create', [
            'listKategori' => Kategori::all(),
            'listPenulis' => Penulis::all(),
            'listPenerbit' => Penerbit::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $file_name = $request->image->getClientOriginalName();

        // $request->image->storeAs('buku', $file_name);

        $request->validate([
            'judul' => 'required',
            'id_kategori' => 'required',
            'id_penulis' => 'required',
            'id_penerbit' => 'required',
            'berkas_sampul' => 'image|file|max:1024'
        ]);

        $buku = new Buku();
        $buku->judul = $request->judul;
        $buku->slug = Str::slug($request->judul, '-');
        $buku->id_kategori = $request->id_kategori;
        $buku->id_penulis = $request->id_penulis;
        $buku->id_penerbit = $request->id_penerbit;

        $berkas_sampul = $request->file('berkas_sampul');

        if ($berkas_sampul != null) { // jika berkas_sampul ada atau diupload
            $nama_berkas = rand(100, 9999) . '-' . $berkas_sampul->getClientOriginalName();
            $berkas_sampul->storeAs('gambar-sampul', $nama_berkas);
            $buku->berkas_sampul = $nama_berkas;
        }

        $buku->save();

        session()->flash('sukses', 'data berhasil ditambahkan');

        return redirect('/buku/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $buku = Buku::findOrFail($id);

        return view('admin.buku.edit', [
            'buku' => $buku,
            'listKategori' => Kategori::all(),
            'listPenulis' => Penulis::all(),
            'listPenerbit' => Penerbit::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);
        $buku->judul = $request->judul;
        $buku->slug = Str::slug($request->judul, '-');
        $buku->id_kategori = $request->id_kategori;
        $buku->id_penulis = $request->id_penulis;
        $buku->id_penerbit = $request->id_penerbit;

        $berkas_sampul = $request->file('berkas_sampul');

        if ($berkas_sampul != null) { // jika berkas_sampul ada atau diupload
            $nama_berkas = rand(100, 9999) . '-' . $berkas_sampul->getClientOriginalName();
            $berkas_sampul->storeAs('gambar-sampul', $nama_berkas);
            $buku->berkas_sampul = $nama_berkas;
        }

        $buku->save();

        session()->flash('sukses', 'data berhasil diupdate');

        return redirect('/buku/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();

        session()->flash('sukses', 'data berhasil dihapus');

        return redirect('/buku/index');
    }
}
