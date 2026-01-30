<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Arsip extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan oleh model ini.
     * (opsional, Laravel secara default menggunakan nama jamak dari nama model, yaitu 'arsips')
     */
    protected $table = 'arsips';

    /**
     * Atribut yang boleh diisi secara massal (fillable).
     */
    protected $fillable = [
        'nama_file',      // Nama file arsip
        'kategori',       // Kategori atau jenis arsip
        'deskripsi',      // Deskripsi tambahan
        'file_path',      // Lokasi file di storage
    ];

    /**
     * Format timestamp Laravel (created_at dan updated_at).
     */
    public $timestamps = true;

    /**
     * (Opsional) Relasi ke user, jika arsip milik user tertentu
     */
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    /**
     * (Opsional) Accessor untuk nama file yang dipersingkat (misalnya hanya nama tanpa path)
     */
    // public function getFileNameOnlyAttribute()
    // {
    //     return basename($this->file_path);
    // }
}
