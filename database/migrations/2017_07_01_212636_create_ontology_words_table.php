<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOntologyWordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ontologies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('text',30);
            $table->enum('parameter', ['pekerjaan', 'pendapatan rumah tangga','kondisi rumah dan aset', 'pendidikan','kesehatan', 'keharmonisan keluarga','hubungan sosial','ketersediaan waktu luang','kondisi lingkungan','kondisi keamanan','tidak terkategori'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ontologies');
    }
}
