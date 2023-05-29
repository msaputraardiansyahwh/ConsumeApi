<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Consume REST API Student</title>
</head>

<body>
    <h2>List Semua Data Student</h2>
    <form action="" method="get">
        @csrf
        <input type="text" name="search" placeholder="Cari nama...">
        <button type="submit">Cari</button>
        <a href="/"
            style="text-decoration: none;  background-color: grey;
    border: none;
    color: #fff;
    padding: 3px 8px;
    text-decoration: none;
    margin: 4px 2px;
    cursor: pointer;">Penyegaran</a>
    </form>
    <a href="{{ route('add') }}" style="text-decoration: none; color: green;">Tambah Data</a> ||
    <a href="{{ route('trash') }}" style="text-decoration: none; color: green;">Lihat Data Terhapus</a>
    @if (Session::get('succes'))
        <p style="padding: 5px 10px; background: green; color: white; margin:10px;">{{ Session::get('succes') }}</p>
    @endif
    @foreach ($student as $students)
        <ol>
            <li>NIS : {{ $students['nis'] }}</li>
            <li>Nama : {{ $students['nama'] }}</li>
            <li>Rombel : {{ $students['rombel'] }}</li>
            <li>Rayon : {{ $students['rayon'] }}</li>
            <li>Aksi : <a href="{{ route('edit', $students['id']) }}" style="background: orange; color: white;  text-decoration: none;">Edit</a> || <form
                    action="{{ route('delete', $students['id']) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background: red; color: white;  text-decoration: none;">Hapus</button>
                </form>
            </li>
        </ol>
    @endforeach
</body>

</html>
