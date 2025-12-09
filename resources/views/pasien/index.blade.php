@extends('layout')

@section('content')
<h2>Daftar Pasien</h2>

<a href="{{ route('pasien.create') }}">+ Tambah Pasien</a>

<table border="1" cellpadding="10">
    <tr>
        <th>Nama</th>
        <th>NIK</th>
        <th>Jenis Kelamin</th>
        <th>No HP</th>
        <th>Aksi</th>
    </tr>

    @foreach($pasiens as $pasien)
    <tr>
        <td>{{ $pasien->nama }}</td>
        <td>{{ $pasien->nik }}</td>
        <td>{{ $pasien->jenis_kelamin }}</td>
        <td>{{ $pasien->no_hp }}</td>
        <td>
            <a href="{{ route('pasien.edit', $pasien->id) }}">Edit</a>
            <form action="{{ route('pasien.destroy', $pasien->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
