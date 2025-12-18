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
        'photo_file',
        'target_nominal',
        'status',
        'target_tanggal',
    ];

    protected $appends = ['photo_url'];

    public function user(){
        return $this->belongsTo(UsersModel::class, 'id_user');
    }

    public function riwayatTabungan(){
        return $this->hasMany(TransaksiTabunganModel::class, 'id_tabungan');
    }

    public function getPhotoUrlAttribute()
    {
        return isset($this->attributes['photo_file'])
            ? asset('storage/' . $this->attributes['photo_file'])
            : null;
    }
}
