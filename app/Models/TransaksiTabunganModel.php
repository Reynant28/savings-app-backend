<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiTabunganModel extends Model
{
    protected $table = 'tb_transaksi_tabungan';
    protected $primaryKey = 'id_riwayat';
    public $incrementing = true;
    protected $fillable = [
        'id_riwayat',
        'id_tabungan',
        'nominal',
        'tanggal',
    ];

    public function tabungan(){
        return $this->belongsTo(TabunganModel::class, 'id_tabungan');
    }
}
