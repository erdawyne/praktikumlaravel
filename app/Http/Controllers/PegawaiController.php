<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PegawaiController extends Controller
{
    public function index()
    {
                //Mengambil data dari tabel pegawai
            $pegawai = DB::table('pegawai')->paginate(5);


                //Mengirim data pegawai ke view index
            return view('pegawai',['pegawai' => $pegawai]);
    }

    public function cari(Request $request)
    {
        //menangkap data pencarian
        $cari = $request->cari;

        //mengambil data dari table mahasiswa sesuai pencarian data
        $pegawai = DB::table('pegawai')
        ->where('pegawai_nama','like',"%".$cari."%")
        ->paginate();


        //mengirim data pegawai ke view index
        return view('pegawai',['pegawai' => $pegawai]);
    }
}
