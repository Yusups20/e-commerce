@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-header">
                Daftar Buku
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                    </thead>
                    <tbody>
                        @foreach ($buku as $item)

                            <td>
                                <div class="card">
                                    &nbsp;
                                    <h4 class="text-center">{{$item->judul}}</h4>
                                    <img class="text-center" src="{{ asset('/storage/gambar-sampul/'.$item->berkas_sampul) }}" alt="{{$item->judul}}" width="200" height="200"
                                    onclick="{{ url('/buku/detail'.$item->id) }}"
                                    >
                                    <div class="card-footer">
                                        <a href="{{ url('/buku/detail/'.$item->id) }}" class="btn btn-primary btn-sm">Detail Buku</a>
                                    </div>
                                </div>
                            </td>
                           
                        
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
