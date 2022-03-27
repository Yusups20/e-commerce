@extends('admin-lte/app')
@section('title', 'Buku')

@section('content')
<div class="row">
    <div class="col-12">
        @include('admin-lte/flash')
        <div class="card">
            <div class="card-header">
                <a href="{{ url('/buku/create') }}" class="btn btn-primary">Tambah</a>
                <a href="{{ url('/buku/export-excel') }}" class="btn btn-success my-3" target="_blank">Export EXCEL</a>
	
                <div class="card-tools">
                    <form action="" method="GET">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="search" class="form-control float-right" placeholder="Cari">
    
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                    <tr>
                        <th class="text-center" width="10%">No</th>
                        <th class="text-center">Sampul</th>
                        <th class="text-center">Judul</th>
                        <th class="text-center">Slug</th>
                        <th class="text-center">Kategori</th>
                        <th class="text-center">Penulis</th>
                        <th class="text-center">Penerbit</th>
                        <th class="text-center" width="15%">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($buku as $item)
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td>
                                <img src="{{ asset('/storage/gambar-sampul/'.$item->berkas_sampul) }}" alt="{{$item->judul}}" width="60" height="80">
                            </td>
                            <td>{{$item->judul}}</td>
                            <td>{{$item->slug}}</td>
                            <td>{{@$item->kategori->nama}}</td>
                            <td>{{@$item->penulis->nama}}</td>
                            <td>{{@$item->penerbit->nama}}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ url('/buku/export-pdf/'.$item->id) }}" class="btn btn-secondary btn-sm">export pdf</a>
                                    <a href="{{ url('/buku/edit/'.$item->id) }}" class="btn btn-primary btn-sm">edit</a>
                                    <a href="{{ url('/buku/destroy/'.$item->id) }}" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Anda yakin ingin menghapus data ?')">delete</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="class card-footer clearfix">
                {{$buku->links()}}
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection