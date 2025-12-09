@extends('layout')

@section('content')
<h2>Tambah Pasien</h2>

<form action="{{ route('pasien.store') }}" method="POST">
    @csrf
    Nama: <input type="text" name="nama"><br>
    NIK: <input type="text" name="nik"><br>
    Tanggal Lahir: <input type="date" name="tanggal_lahir"><br>
    Gender:
    <select name="jenis_kelamin">
        <option value="L">Laki-laki</option>
        <option value="P">Perempuan</option>
    </select><br>
    Alamat: <textarea name="alamat"></textarea><br>
    No HP: <input type="text" name="no_hp"><br>

    <button type="submit">Simpan</button>
</form>
@endsection
