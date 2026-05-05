<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $fillable = [
        'user_id',
        'no_pendaftaran',
        'prodi',
        'gelombang',
        'is_profile_complete',
        'is_document_uploaded',
        'is_payment_uploaded',
        'status_kelulusan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
