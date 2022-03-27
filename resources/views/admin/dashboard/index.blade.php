@extends('admin-lte/app')

@section('title','Dashboard')
    
@section('content')
    <h2>Jumlah Buku Per-Kategori</h2>
    <div id="kategoriChart">
        {!! $kategoriChart->container() !!}
    </div>
    <h2>Jumlah Buku Per-Penulis</h2>
    <div id="penulisChart">
        {!! $penulisChart->container() !!}
    </div>
    <h2>Jumlah Buku Per-Penerbit</h2>
    <div id="penerbitChart">
        {!! $penerbitChart->container() !!}
    </div>
@endsection

@push('scripts')
    {!! $kategoriChart->script() !!}
    {!! $penulisChart->script() !!}
    {!! $penerbitChart->script() !!}
@endpush