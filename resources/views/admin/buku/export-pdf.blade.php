<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Buku</title>
</head>
<body>
    <h1 style="text-align: center">{{ $buku->judul }}</h1>
    <div>
        <img src="{{ asset('/storage/gambar-sampul/'.$buku->berkas_sampul) }}" alt="{{$buku->judul}}" width="200" height="120">
        <h3 style="text-align: left">Kategori :{{ $buku->kategori->nama }}</h3>
        <h3 style="text-align: left">Kategori :{{ $buku->penulis->nama }}</h3>
        <h3 style="text-align: left">Kategori :{{ $buku->penerbit->nama }}</h3>
    </div>
</body>
</html>