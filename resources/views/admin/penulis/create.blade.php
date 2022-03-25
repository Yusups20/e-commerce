@extends('admin-lte/app')

@section('title','Tambah Penulis')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ url('/penulis/store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="nama">Nama Penulis</label>
                    <input type="text" name="nama" class="form-control">
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection