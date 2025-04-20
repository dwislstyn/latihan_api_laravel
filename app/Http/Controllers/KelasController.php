<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use Illuminate\Support\Facades\DB;
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
}
