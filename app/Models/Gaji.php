<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;

    protected $table = 'gajis';

    protected $fillable = [
        'id_detail_user',
        'tanggal',
        'total_presensi',
        'total_lembur',
        'potongan',
        'potongan_absen',
        'lembur',
        'total_gaji',
        'insentif',
        'status',
    ];

    public function detailUser()
    {
        return $this->belongsTo(DetailUser::class, 'id_detail_user', 'id');
    }
}
