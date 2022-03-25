@if ($edit)
<div class="card">
  <div class="card-body">
    <div class="form-group">
      <label for="nama">Nama Kategori</label>
      <input wire:model="nama" type="text" class="form-control" id="nama" name="nama" required>
      @error('nama') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    <span wire:click="update({{$kategori_id}})" href="" class="btn btn-sm btn-success">update</span>
  </div>
</div>
@endif