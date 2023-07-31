<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tambahan extends Model
{
    use HasFactory;

    protected $table = 'tambahans';

    protected $fillable = [
        'nama_tambahan',
        'persentase_tambahan',
    ];
}
