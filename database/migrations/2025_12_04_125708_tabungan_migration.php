<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_tabungan', function (Blueprint $table) {
            $table->increments('id_tabungan');
            $table->unsignedInteger('id_user');
            $table->string('nama_tabungan');
            $table->string('photo_url')->nullable();
            $table->decimal('target_nominal', 15, 2);
            $table->enum('status', ['aktif', 'selesai'])->default('aktif');
            $table->date('target_tanggal');
            $table->timestamps();

            $table->foreign('id_user')
            ->references('id_user')
            ->on('tb_users')
            ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabungan');
    }
};
