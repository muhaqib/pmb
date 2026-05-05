<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $fillable = [
        'user_id',
        'jenis_dokumen',
        'file_path',
        'file_name',
        'status',
        'keterangan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
