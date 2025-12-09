@extends('layout')

@section('content')
<h2>Edit Pasien</h2>

<form action="{{ route('pasien.update', $pasien->id) }}" method="POST">
    @csrf
    @method('PUT')

    Nama: <input type="text" name="nama" value="{{ $pasien->nama }}"><br>
    NIK: <input type="text" name="nik" value="{{ $pasien->nik }}"><br>
    Tanggal Lahir: <input type="date" name="tanggal_lahir" value="{{ $pasien->tanggal_lahir }}"><br>
    Gender:
    <select name="jenis_kelamin">
        <option value="L" {{ $pasien->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
        <option value="P" {{ $pasien->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
    </select><br>
    Alamat: <textarea name="alamat">{{ $pasien->alamat }}</textarea><br>
    No HP: <input type="text" name="no_hp" value="{{ $pasien->no_hp }}"><br>

    <button type="submit">Update</button>
</form>
@endsection
