<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pasien</title>
    <!-- Ganti dengan link CSS framework Anda (misalnya Tailwind, Bootstrap) -->
    <style>
        body { font-family: sans-serif; margin: 20px; }
        .container { max-width: 1200px; margin: auto; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .btn { padding: 8px 12px; border: none; cursor: pointer; border-radius: 4px; text-decoration: none; display: inline-block; }
        .btn-primary { background-color: #007bff; color: white; }
        .btn-success { background-color: #28a745; color: white; }
        .btn-danger { background-color: #dc3545; color: white; }
        .btn-info { background-color: #17a2b8; color: white; } /* Menambahkan style untuk tombol Detail */
        .alert-success { background-color: #d4edda; color: #155724; padding: 10px; border-radius: 4px; margin-bottom: 15px; border: 1px solid #c3e6cb; }
        .btn-sm { padding: 5px 10px; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Daftar Pasien Klinik Kubah Mas</h1>

        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('pasien.create') }}" class="btn btn-primary">
            + Tambah Pasien Baru
        </a>

        <table class="table">
            <thead>
                <tr>
                    <th>ID Pasien</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>J. Kelamin</th>
                    <th>No. HP</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pasiens as $pasien)
                    <tr>
                        <td>{{ $pasien->id }}</td>
                        <td>{{ $pasien->user->name ?? 'N/A' }}</td>
                        <td>{{ $pasien->user->email ?? 'N/A' }}</td>
                        <td>{{ $pasien->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                        <td>{{ $pasien->no_hp }}</td>
                        <td>{{ Str::limit($pasien->alamat, 30) }}</td>
                        <td style="white-space: nowrap;">
                            <!-- Tombol Baru: Lihat Detail -->
                            <a href="{{ route('pasien.show', $pasien->id) }}" class="btn btn-sm btn-info">Detail</a>
                            
                            <a href="{{ route('pasien.edit', $pasien->id) }}" class="btn btn-sm btn-success">Edit</a>
                            
                            <form action="{{ route('pasien.destroy', $pasien->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data pasien ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>