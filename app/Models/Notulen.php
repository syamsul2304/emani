<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notulen extends Model
{
    use HasFactory;

    protected $table = 'notulens';

    protected $fillable = [
        'judul_rapat',
        'tanggal_rapat',
        'waktu_mulai',
        'waktu_selesai',
        'tempat',
        'pembicara',
        'isi_notulen',
    ];

    protected $dates = [
        'tanggal_rapat',
    ];
}
