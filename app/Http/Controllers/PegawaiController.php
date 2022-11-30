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
}
