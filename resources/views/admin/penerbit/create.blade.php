@extends('admin-lte/app')

@section('title','Tambah Penerbit')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ url('/penerbit/store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="nama">Nama Penerbit</label>
                    <input type="text" name="nama" class="form-control">
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection