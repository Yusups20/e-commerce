@extends('admin-lte/app')

@section('title','Tambah Data Buku')

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <form action="{{ url('/buku/store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="nama">Judul Buku</label>
                        <input type="text" name="judul" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="kategori">Kategori</label>
                        <select class="form-control" name="id_kategori">
                            <option value="" selected>- pilih kategori -</option>
                            @foreach ($listKategori as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="penulis">Penulis</label>
                        <select class="form-control" name="id_penulis">
                            <option value="" selected>- pilih penulis -</option>
                            @foreach ($listPenulis as $penulis)
                                <option value="{{ $penulis->id }}">{{ $penulis->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="penerbit">Penerbit</label>
                        <select class="form-control" name="id_penerbit">
                            <option value="" selected>- pilih penerbit -</option>
                            @foreach ($listPenerbit as $penerbit)
                                <option value="{{ $penerbit->id }}">{{ $penerbit->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="formFile">Upload Gambar Sampul</label>
                        <input class="form-control" name="berkas_sampul" type="file" id="formFile">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection