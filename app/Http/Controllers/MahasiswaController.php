<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\DB;


class MahasiswaController extends Controller
{
    public function index()
    {
                //Mengambil data dari tabel pegawai
            $mahasiswa = DB::table('mahasiswa')->paginate(5);


                //Mengirim data mahasiswa ke view index
            return view('mahasiswa.index',['mahasiswa' => $mahasiswa]);
    }

    // public function index(Request $request)
    // {
    //     //$data_mahasiswa = DB::table('mahasiswa')->paginate(5);

    //     if($request->has('cari')){
    //         $data_mahasiswa = \App\Models\Mahasiswa::where('nama','LIKE','%'.$request->cari . '%')->get();
    //     }else{
    //         $data_mahasiswa = \App\Models\Mahasiswa::paginate(8);
    //     }

    //     return view('mahasiswa.index',['data_mahasiswa' => $data_mahasiswa]);
    // }

    public function cari(Request $request)
    {
        //menangkap data pencarian
        $cari = $request->cari;

        //mengambil data dari table mahasiswa sesuai pencarian data
        $mahasiswa = DB::table('mahasiswa')
        ->where('nama','like',"%".$cari."%")
        ->paginate();


        //mengirim data pegawai ke view index
        return view('mahasiswa.index',['mahasiswa' => $mahasiswa]);
    }

    public function create(Request $request)
    {
        Mahasiswa::create($request->all());
        return redirect('/mahasiswa')->with('Sukses', 'Data berhasil di input');
    }

    public function edit($id)
    {
        $data_mahasiswa = \App\Models\Mahasiswa::find($id);
        return view('mahasiswa.edit' ,['mahasiswa' => $data_mahasiswa]);
    }

    public function update(Request $request, $id)
    {
        $data_mahasiswa = \App\Models\Mahasiswa::find($id);
        $data_mahasiswa->update($request->all());
        return redirect('/mahasiswa')->with('Sukses','Data berhasil diupdate');
    }
    
    public function delete($id)
    {
        $data_mahasiswa = \App\Models\Mahasiswa::find($id);
        $data_mahasiswa->delete();
        return redirect('/mahasiswa')->with('Sukses','Data berhasil dihapus');
    }

    public function exportPdf()
    {
        $data_mahasiswa = \App\Models\Mahasiswa::all();
        $pdf = PDF::loadView('export.mahasiswapdf',['mahasiswa' => $data_mahasiswa]);
        return $pdf->download('mahasiswa.pdf');
    }
}
