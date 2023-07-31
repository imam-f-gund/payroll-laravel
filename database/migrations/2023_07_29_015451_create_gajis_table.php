<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gajis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_detail_user');
            $table->foreign('id_detail_user')->references('id')->on('detail_users')->onDelete('cascade');
            $table->date('tanggal');
            $table->string('total_presensi')->nullable();//api presensi per bulan
            $table->string('total_lembur')->nullable();//api lembur per jam
            $table->string('insentif')->nullable();//dari perhitungan insentif jika terpenuhi sebagai status Tetap masa kerja < 1 tahun = 1000.000, dan masa kerja = 1 tahun + 100.000, tiap tahun bertambah 100.000
            $table->string('lembur')->nullable();//dari perhitungan lembur 
            $table->string('potongan')->nullable();
            $table->string('potongan_absen')->nullable();
            $table->string('total_gaji')->nullable();
            $table->enum('status', ['approval', 'reject','pending'])->default('pending');
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
        Schema::dropIfExists('gajis');
    }
};
