<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'tbl_data_guru';

    protected $fillable = [
        'id_guru',
        'nama_guru',
        'tempat_lahir',
        'tanggal_lahir',
        'detail_mapel',
        'alamat',
        'no_tlp'
    ];
    
    protected $casts = [
        'id_guru' => 'integer',
        'nama_guru' => 'string',
        'tempat_lahir' => 'string',
        'tanggal_lahir' => 'datetime:Y-m-d',
        'detail_matpel' => 'string',
        'alamat' => 'string',
        'no_tlp' => 'string',
    ];
}
