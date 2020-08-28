<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class t_user extends Model
{
    protected $table = 't_user';
    protected $fillable = ['nama', 'jenis_kelamin', 'agama', 'tempat_lahir', 'tgl_lahir', 'no_telp', 'alamat', 'password', 'foto', 'id_role'];
}
