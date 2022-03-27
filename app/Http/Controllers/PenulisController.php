<?php

namespace App\Http\Controllers;

use App\Models\Penulis;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PenulisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $penulis = Penulis::where('nama','like','%'.$search.'%')->latest()->paginate(5);

        return view('admin.penulis.index', compact('penulis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.penulis.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required'
        ],[
            'nama.required' => 'Nama Penulis wajib diisi'
        ]);

        $penulis = new Penulis();
        $penulis->nama = $request->nama;
        $penulis->slug = Str::slug($request->nama,'-');
        $penulis->save();
        
        session()->flash('sukses','data berhasil ditambahkan');

        return redirect('/penulis/index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $penulis = Penulis::findOrFail($id);

        return view('admin.penulis.edit', compact('penulis'));
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
        $penulis = Penulis::findOrFail($id);
        $penulis->nama = $request->nama;
        $penulis->slug = Str::slug($request->nama,'-');
        $penulis->save();
        
        session()->flash('sukses','data berhasil diupdate');

        return redirect('/penulis/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $penulis = Penulis::findOrFail($id);
        $penulis->delete();

        session()->flash('sukses','data berhasil dihapus');

        return redirect('/penulis/index');
    }
}
