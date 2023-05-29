<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Libraries\BaseApi;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // mengambil data dari input search
        $search = $request->search;
        // mengambil libraries BaseApi method nya index dengan mengirim parameter1 berupa path data dari API nya, parameter2 data untuk mengisi search_nama API nya
        // BaseApi untuk memanggil base 
        $data = (new BaseApi)->index('/api/student', ['search_nama' => $search]);
        // ambil response json
        $student = $data->json();
        // dd($students);
        // 'student ngambil dari '
        return view('index')->with(['student' => $student['data']]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'nama' => $request->nama,
            'nis' => $request->nis,
            'rombel' => $request->rombel,
            'rayon' => $request->rayon,
        ];

        $proses = (new BaseApi)->store('/api/student/tambah-data', $data);
        if ($proses->failed()) {
            $errors = $proses->json('data');
            return redirect()->back()->with(['errors' => $errors]);
        }else {
            return redirect('/')->with('success', 'Berhasil menambahkan data baru ke students API');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // proses ambildata api ke route REST API /students/{id}
        // fungsi titik untuk menyambungkan
        $data = (new BaseApi)->edit('/api/student/' .$id);
        if ($data->failed()) {
            // kalau gagal proes $data diatas, ambil dieskriptif err dari json property data
            $errors =  $data->json(['data']);
            // balikin ke halaman awal, sama errors nya
            return redirect()->back()->with(['errors' => $errors]);
        } else {
            // kalau berhasil, ambil data dari jsonnya
            $student = $data->json(['data']);
            // alihkan ke bride edit dengan mengirim data $student diatas agar bisa digunakan pada bldae
            return view('edit')->with(['student' => $student]);
        }
        
    }

    /**                 
     * Update the specified resource in storage.
     */

     // request $request ngambil data dari inputan
    public function update(Request $request, $id)
    {
        // data yang akan dikirim ($request ke REST API)
        $payload = [
            'nama' => $request->nama,
            'nis' => $request->nis,
            'rombel' => $request->rombel,
            'rayon' => $request->rayon,
        ];

        // panggil method update dari BaseApi, kiri endpoint (route update dari Rest APInya) dan data ($payload diatas)
        // koma (,) untuk memisahkan / titik (.) untuk menghubungkan`
        $proses = (new BaseApi)->update('/api/students/update/'. $id , $payload);
        if ($proses->failed()) {
            // kalau gagal, balikin lagi sama pesan errors dari json nya
            $errors = $proses->json('data');
            // dd($errors);
            return redirect()->back()->with(['errors' => $errors]);
        }else {
            // berhasil, balikin ke halaman paling awa dengan pesan
            return redirect('/')->with('succes', 'Berhasil mengubah data siswa dari API');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $proses = (new BaseApi)->delete('/api/students/delete/' .$id);

        if ($proses->failed()) {
            $errors = $proses->json('data');
            return redirect()>back()->with(['errors' => $errors]);
        } else {
            return redirect('/')->with('succes', 'Berhasil hapus data sementara dari API');
        }
    }

    public function trash()
    {
        $proses = (new BaseApi)->trash('/api/students/show/trash');
        if ($proses->failed()) {
            $errors = $proses->json('data');
            return redirect()->back()->with(['errors' => $errors]);
        }else {
            $studentsTrash = $proses->json('data');
            return view('trash')->with(['studentsTrash' => $studentsTrash]);
        }
    }

    public function restore($id)
    {
        $proses = (new BaseApi)->restore('/api/students/trash/restore/'. $id);
        if ($proses->failed()) {
            $errors =$proses->json('data');
            return redirect()->back()->with(['errors'=>$errors]);
        }else {
            return redirect('/')->with('succes', 'Berhasil mengambalikan data');
        }
    }

    public function permanent($id)
    {
        $proses = (new BaseApi)->permanent('/api/students/trash/delete/permanent/'. $id);
        if ($proses->failed()) {
            $errors =$proses->json('data');
            return redirect()->back()->with(['errors'=>$errors]);
        }else {
            return redirect()->back()->with('succes', 'Berhasil menghapus data secara permanent');
        }     
    }
}
