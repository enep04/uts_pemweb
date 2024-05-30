<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('datagurus', function (Blueprint $table) {
            $table->id();
            $table->string('nama_guru')->nullable();
            $table->string('ttl')->nullable();
            $table->string('description')->nullable();
            $table->string('riwayat_pendidikan')->nullable();
            $table->string('universitas')->nullable();
            $table->string('mata_pelajaran')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

};
