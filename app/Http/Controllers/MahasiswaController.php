<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kelas;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    //fungsi eloquent menampilkan data menggunakan pagination
    $mahasiswas = Mahasiswa::orderBy('nim', 'desc')->paginate(6);
    // Mengambil semua isi tabel
    $posts = Mahasiswa::orderBy('nim', 'desc')->paginate(6);
    return view('mahasiswas.index', compact('posts'));
    // with('i', (request()->input('page', 1) - 1) * 5); 
    }
    
    public function search(Request $request)
	{
		// menangkap data pencarian
		$cari = $request->search;
        $posts = Mahasiswa::where('nama', 'LIKE', '%'. $cari . '%')->paginate(6);
        return view('mahasiswas.index', ['posts'=>$posts]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelas = Kelas::all();
        return view('mahasiswas.create',['kelas' => $kelas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'no_handphone' => 'required',
            'email' => 'required',
            'tgl_lahir' => 'required'
            ]);

            //fungsi eloquent untuk menambah data
            Mahasiswa::create($request->all());
            //jika data berhasil ditambahkan, akan kembali ke halaman utama
            return redirect()->route('mahasiswas.index')->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $nim)
    {
        //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
        $Mahasiswa = Mahasiswa::find($nim);
        return view('mahasiswas.detail', compact('Mahasiswa'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $nim)
    {
        //menampilkan detail data dengan menemukan berdasarkan Nim Mahasiswa untuk diedit
        $Mahasiswa = Mahasiswa::find($nim);
        return view('mahasiswas.edit', compact('Mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $nim)
    {
        //melakukan validasi data
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'no_handphone' => 'required',
            'email' => 'required',
            'tgl_lahir' => 'required'
            ]);
        //fungsi eloquent untuk mengupdate data inputan kita
            Mahasiswa::find($nim)->update($request->all());
        //jika data berhasil diupdate, akan kembali ke halaman utama
            return redirect()->route('mahasiswas.index')
                ->with('success', 'Mahasiswa Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $nim)
    {
        //fungsi eloquent untuk menghapus data
            Mahasiswa::find($nim)->delete();
            return redirect()->route('mahasiswas.index')
                -> with('success', 'Mahasiswa Berhasil Dihapus');
    }

};
