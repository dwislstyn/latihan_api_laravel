<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use stdClass;

class GuruController extends Controller
{
    private $output;

    public function __construct()
    {
        $this->output = new stdClass();
        $this->output->responseCode = '';
        $this->output->responseDesc = '';
    }

    public function insertDataGuru(Request $request)
    {
     $dataGuru = new Guru();
    $dataGuru->nama_guru = $request->nama_guru;   
     $dataGuru->tempat_lahir = $request->tempat_lahir;   
     $dataGuru->tanggal_lahir = $request->tanggal_lahir;   
     $dataGuru->detail_matpel = $request->detail_matpel;   
     $dataGuru->alamat= $request->alamat;   
     $dataGuru->no_tlp = $request->no_tlp;   

     $insertData = DB::table('tbl_data_guru')->insert($dataGuru->toArray());   

     if($insertData === false) {
        $this->output->responseCode = '01';
        $this->output->responseDesc = 'Insert data guru gagal.';
     }else{
        $this->output->responseCode= '00';
        $this->output->responseDesc= 'insert data guru sukses.';
     }

     return $this->output;
    }
    public function updateDataGuru(Request $request)
    {
       if(empty($request->id_guru)) {
        $this->output->responseCode = '01';
        $this->output->responseDesc = 'parameter ID guru valid';
       }

       $queryGuru = DB::table('tbl_data_guru')->where('id_guru', $request->id_guru)->first();
       if(empty($queryGuru)) {
        $this->output->responseCode = '02';
        $this->output->responseDesc = "Data Guru dengan ID: $request->id_guru tidak ditemukan";
       }

       $Guru = new Guru();

       $Guru->nama_guru = !empty($request->nama_guru) ? $request->nama_guru : (empty($queryGuru->nama_guru) ? null : $queryGuru->nama_guru);
       $Guru->tempat_lahir = !empty($request->tempat_lahir) ? $request->tempat_lahir : (empty($queryGuru->tempat_lahir) ? null : $queryGuru->tempat_lahir);
       $Guru->tanggal_lahir = !empty($request->tanggal_lahir) ? $request->tanggal_lahir : (empty($queryGuru->tanggal_lahir) ? null : $queryGuru->tanggal_lahir);
       $Guru->detail_matpel = !empty($request->detail_matpel) ? $request->detail_matpel : (empty($queryGuru->detail_matpel) ? null : $queryGuru->detail_matpel);
       $Guru->no_tlp = !empty($request->no_tlp) ? $request->no_tlp : (empty($queryGuru->no_tlp) ? null : $queryGuru->no_tlp);
       $Guru->alamat = !empty($request->alamat) ? $request->alamat : (empty($queryGuru->alamat) ? null : $queryGuru->alamat);

       $statusUpdate = false;
        
       
       try {
        $updateGuru = DB::table('tbl_data_guru')->where('id_guru', $request->id_guru)->update($Guru->toArray());
        $statusUpdate = true;
       } catch (\Throwable $th) {
        $statusUpdate = false;
       }

       if($statusUpdate === false) {
        $this->output->responseCode = '04';
        $this->output->responseDesc = "Update data guru gagal.";
       }else {
        $this->output->responseCode = '00';
        $this->output->responseDesc = 'update data guru berhasi.';
       }
        return $this->output;
    }
}
