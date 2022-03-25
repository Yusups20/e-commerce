@extends('admin-lte/app')

@section('title','Edit Penulis')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ url('/penulis/update/'.$penulis->id) }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="nama">Nama Penulis</label>
                    <input type="text" name="nama" class="form-control" value="{{ $penulis->nama }}">
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection