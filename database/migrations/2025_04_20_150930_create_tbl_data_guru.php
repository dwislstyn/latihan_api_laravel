<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblDataGuru extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_data_guru', function (Blueprint $table) {
            $table->bigIncrements('id_guru');
            $table->string('nama_guru');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('detail_matpel');
            $table->longText('alamat');
            $table->string('no_tlp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_data_guru');
    }
}
