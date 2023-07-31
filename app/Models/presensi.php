<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class presensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_detail_user',
        'tanggal',
        'jam_masuk',
        'jam_keluar',
    ];

    public function detailUser()
    {
        return $this->belongsTo(DetailUser::class, 'id_detail_user', 'id');
    }
}
