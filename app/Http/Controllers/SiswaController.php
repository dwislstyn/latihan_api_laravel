<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use Illuminate\Support\Facades\DB;
use stdClass;

class SiswaController extends Controller
{
    private $output;

    public function __construct()
    {
        $this->output = new stdClass();
        $this->output->responseCode = '';
        $this->output->responseDesc = '';
    }


    public function insertDataSiswa(Request $request)
    {
        $dataSiswa = new Siswa();
        $dataSiswa->nama_siswa = $request->nama_siswa;
        $dataSiswa->alamat = $request->alamat;
        $dataSiswa->no_telp = $request->no_telp;

        $insertData = DB::table('tbl_siswa')->insert($dataSiswa->toArray());
        
        if ($insertData === false) {
            $this->output->responseCode = '01';
            $this->output->responseDesc = 'Insert data siswa gagal.';
        } else {
            $this->output->responseCode = '00';
            $this->output->responseDesc = 'Insert data siswa sukses.';

        }

        return $this->output;
    }
}
