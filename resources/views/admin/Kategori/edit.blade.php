@extends('admin-lte/app')

@section('title','Edit Kategori')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ url('/kategori/update/'.$kategori->id) }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="nama">Nama Kategori</label>
                    <input type="text" name="nama" class="form-control" value="{{ $kategori->nama }}">
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection