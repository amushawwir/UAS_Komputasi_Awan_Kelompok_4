<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendaftar', function (Blueprint $table) {
                //form siswa
                $table->id();
                $table->string('nama', 200);    
                $table->string('nisn', 45);    
                $table->string('tempat_lahir', 45);    
                $table->date('tanggal_lahir');
                $table->string('jenisKel', 45);    
                $table->string('email', 45);   
                $table->longText('alamat');   
                $table->string('telp', 45); 
                $table->string('agama', 45);
                $table->string('asalSekolah', 100);
                $table->enum('jurusan', ['IPA', 'IPS', 'BAHASA'])->nullable();
                $table->text('url_foto')->nullable();
    
                //form ortu
                $table->string('nama_ayah', 200);    
                $table->string('pekerjaan_ayah', 100);
                $table->string('pendidikan_ayah', 100); 
                $table->string('nama_ibu', 200);    
                $table->string('pekerjaan_ibu', 100); 
                $table->string('pendidikan_ibu', 100); 
                
    
                $table->unsignedBigInteger('user_id')->nullable(); 
                $table->foreign('user_id')->references('id')->on('user'); 

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
        Schema::dropIfExists('pendaftar');
    }

    
}
