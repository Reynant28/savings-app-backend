<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UsersModel extends Authenticatable
{
    protected $table = 'tb_users';
    protected $primaryKey = 'id_user';
    public $incrementing = true;
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'username',
        'email',
        'password'
    ];

    // public function tabungan(){
    //     return $this->hasMany(TabunganModel::class, 'id_user');
    // }
}
