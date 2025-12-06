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
        Schema::create('tb_transaksi_tabungan', function (Blueprint $table) {
            $table->increments('id_riwayat');
            $table->unsignedInteger('id_tabungan');
            $table->decimal('nominal', 15, 2);
            $table->date('tanggal');
            $table->timestamps();

            $table->foreign('id_tabungan')
            ->references('id_tabungan')
            ->on('tb_tabungan')
            ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_transaksi_tabungan');
    }
};
