<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('datagus', function (Blueprint $table) {
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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datagus');
    }
};
