<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'tbl_siswa';

    protected $fillable = [
        'id_siswa',
        'nama_siswa',
        'alamat',
        'no_tlp',

    ];
    protected $casts = [
        'id_siswa' => 'integer',
        'nama_siswa' => 'string',
        'alamat' => 'string',
        'no_tlp' => 'string',

    ];
}
