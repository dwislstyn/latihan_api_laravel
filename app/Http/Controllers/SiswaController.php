<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use Illuminate\Support\Facades\DB;
use stdClass;
use Illuminate\Support\Facades\Validator;

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

    public function updateDataSiswa(Request $request)
    {
        if (empty($request->id_siswa)) {
            $this->output->responseCode = '01';
            $this->output->responseDesc = 'Parameter ID siswa tidak valid';
        }

        $querySiswa = DB::table('tbl_siswa')->where('id_siswa', $request->id_siswa)->first();

        if (empty($querySiswa)) {
            $this->output->responseCode = '02';
            $this->output->responseDesc = "Data siswa dengan ID: $request->id_siswa tidak ditemukan.";
        }

        $siswa = new Siswa();

        $siswa->nama_siswa = !empty($request->nama_siswa) ? $request->nama_siswa : (empty($querySiswa->nama_siswa) ? null : $querySiswa->nama_siswa);
        $siswa->alamat = !empty($request->alamat) ? $request->alamat : (empty($querySiswa->alamat) ? null : $querySiswa->alamat);
        $siswa->no_telp = !empty($request->no_telp) ? $request->no_telp : (empty($querySiswa->no_telp) ? null : $querySiswa->no_telp);

        $statusUpdate = false;

        try {
            DB::table('tbl_siswa')->where('id_siswa', $request->id_siswa)->update($siswa->toArray());

            $statusUpdate = true;
        } catch (\Throwable $th) {
            $statusUpdate = false;
        }

        if ($statusUpdate === false) {
            $this->output->responseCode = '04';
            $this->output->responseDesc = "Update data siswa gagal.";
        } else {
            $this->output->responseCode = '00';
            $this->output->responseDesc = "Update data siswa berhasil.";
        }

        return $this->output;
    }
}
