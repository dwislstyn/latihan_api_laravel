<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblDataKelas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_kelas', function (Blueprint $table) {
            $table->increments('id_kelas')->unsigned();
            $table->string('keterangan_kelas', 100)->nullable();

            $table->index('id_kelas', 'idx_id_kelas')->using('BTREE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_kelas');
    }
}
