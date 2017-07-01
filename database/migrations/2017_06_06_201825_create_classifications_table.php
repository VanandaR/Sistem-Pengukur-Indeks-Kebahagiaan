<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_tweet');
            $table->double('lexicon_pos_score');
            $table->double('lexicon_neg_score');
            $table->enum('manual_sentimen_label', ['positif', 'negatif','netral'])->nullable();
            $table->enum('manual_category_label', ['pekerjaan', 'pendapatan rumah tangga','kondisi rumah dan aset', 'pendidikan','kesehatan', 'keharmonisan keluarga','hubungan sosial','ketersediaan waktu luang','kondisi lingkungan','kondisi keamanan','tidak terkategori'])->nullable();
            $table->enum('prediksi_sentimen_label', ['positif', 'negatif','netral'])->nullable();
            $table->enum('prediksi_category_label', ['pekerjaan', 'pendapatan rumah tangga','kondisi rumah dan aset', 'pendidikan','kesehatan', 'keharmonisan keluarga','hubungan sosial','ketersediaan waktu luang','kondisi lingkungan','kondisi keamanan','tidak terkategori'])->nullable();
            $table->double('nb_pos_probability');
            $table->double('nb_neg_probability');

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
        Schema::dropIfExists('classifications');
    }
}
