<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use stdClass;

class KelasController extends Controller
{
    private $output;

    public function __construct()
    {
        $this->output = new stdClass();
        $this->output->responseCode = '';
        $this->output->responseDesc = '';
    }

    public function insertDataKelas(Request $request)
    {
     $dataKelas = new Kelas();
     $dataKelas->id_kelas = $request->id_kelas;   
     $dataKelas->keterangan_kelas = $request->keterangan_kelas;   

     $insertData = DB::table('tbl_kelas')->insert($dataKelas->toArray());   

     if($insertData === false) {
        $this->output->responseCode = '01';
        $this->output->responseDesc = 'Insert data kelas gagal.';
     }else{
        $this->output->responseCode= '00';
        $this->output->responseDesc= 'insert data kelas sukses.';
     }

     return $this->output;
    }
    public function updateDataKelas(Request $request)
    {
       if(empty($request->id_kelas)) {
        $this->output->responseCode = '01';
        $this->output->responseDesc = 'parameter ID kelas tidak valid';
       }

       $queryKelas = DB::table('tbl_kelas')->where('id_kelas', $request->id_kelas)->first();
       if(empty($queryKelas)) {
        $this->output->responseCode = '02';
        $this->output->responseDesc = "Data kelas dengan ID: $request->id_kelas tidak ditemukan";
       }

       $Kelas = new Kelas();

       $Kelas->keterangan_kelas = empty($request->keterangan_kelas) ? $request->nama_siswa : (empty($queryKelas->keterangan_kelas) ? null : $queryKelas->keterangan_kelas);

       $statusUpdate = false;
        
       
       try {
        $updateKelas = DB::table('tbl_kelas')->where('id_kelas', $request->id_kelas)->update($Kelas->toArray());
        $statusUpdate = true;
       } catch (\Throwable $th) {
        $statusUpdate = false;
       }

       if($statusUpdate === false) {
        $this->output->responseCode = '04';
        $this->output->responseDesc = "Update data kelas gagal.";
       }else {
        $this->output->responseCode = '00';
        $this->output->responseDesc = 'update data siswa berhasi.';
       }
        return $this->output;
    }
}
