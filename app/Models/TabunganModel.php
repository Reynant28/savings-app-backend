<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TabunganModel extends Model
{
    protected $table = 'tb_tabungan';
    protected $primaryKey = 'id_tabungan';
    public $incrementing = true;
    protected $fillable = [
        'id_user',
        'nama_tabungan',
        'photo_url',
        'target_nominal',
        'status',
        'target_tanggal',
    ];

    public function user(){
        return $this->belongsTo(UsersModel::class, 'id_user');
    }
}
