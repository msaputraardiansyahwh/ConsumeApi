<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>trash</title>
</head>
<body>
    @if (Session::get('succes'))
    <p style="padding: 5px 10px; background: green; color: white; margin:10px;">{{ Session::get('succes') }}</p>
@endif
    <a href="/" style="background: grey; color: white;  text-decoration: none;">Kembali</a>
    @foreach ($studentsTrash as $student)
    <ol><li>NIS : {{ $student['nis'] }}</li>
        <li>Nama : {{ $student['nama'] }}</li>
        <li>Rombel : {{ $student['rombel'] }}</li>
        <li>Rayon : {{ $student['rayon'] }}</li>
        <li>Dihapus Tanggal : {{\Carbon\Carbon::parse($student ['deleted_at'])->format('j F, y') }}</li>
        <li>
            <a href="{{route('restore', $student['id'])}}" style="background: green; color: white;  text-decoration: none;">Kembalikan Data</a>
            <a href="{{route('permanent', $student['id'])}}" style="background: red; color: white; text-decoration: none;">Hapus Permanet</a>
        </li>
    </ol> 
        
    @endforeach
</body>
</html>