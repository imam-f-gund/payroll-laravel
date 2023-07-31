<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'id_user',
        'status',
        'gaji_pokok',
        'tunjangan',
        'tanggal_masuk',
        'id_tambahan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function tambahan()
    {
        return $this->belongsTo(tambahan::class, 'id_tambahan', 'id');
    }   
    
}
