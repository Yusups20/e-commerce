<div class="row">
    <div class="col-12">

      @if (session('sukses'))
          <div class="alert alert-success">
                {{session('sukses')}}
          </div>    
      @endif

      @if ($create)
          <div class="card">
            <div class="card-body">
              <div class="form-group">
                <label for="nama">Nama Kategori</label>
                <input wire:model="nama" type="text" class="form-control" id="nama" name="nama" required>
                @error('nama') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
              <span wire:click="store" href="" class="btn btn-sm btn-success">Create</span>
            </div>
          </div>
      @endif


      <div class="card">
        <div class="card-header">
          <span wire:click="create" class="btn btn-sm btn-primary">Tambah</span>

          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

              <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th width="10%">No</th>
                <th>Kategori</th>
                <th width="15%">Aksi</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($kategori as $item)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->nama}}</td>
                <td>
                    <div>
                        <span class="clas btn-group">
                            <span class="class btn-sm btn-primary mr-2">Edit</span>
                            <span class="class btn-sm btn-danger">Hapus</span>
                        </span>
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