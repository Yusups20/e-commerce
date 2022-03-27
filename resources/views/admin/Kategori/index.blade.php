@extends('admin-lte/app')
@section('title', 'Kategori')

@section('content')
<div class="row">
    <div class="col-12">
        @include('admin-lte/flash')
        <div class="card">
            <div class="card-header">
                <a href="{{ url('/kategori/create') }}" class="btn btn-primary">Tambah</a>

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
                        <th class="text-center">Nama</th>
                        <th class="text-center">Slug</th>
                        <th class="text-center" width="15%">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategori as $item)
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td>{{$item->nama}}</td>
                            <td>{{$item->slug}}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ url('/kategori/edit/'.$item->id) }}" class="btn btn-primary btn-sm">edit</a>
                                    <a href="{{ url('/kategori/destroy/'.$item->id) }}" class="btn btn-danger btn-sm"
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
                {{$kategori->links()}}
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection