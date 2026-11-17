<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentNote extends Model
{
    protected $fillable = [
        'user_id',
        'tempat_belajar_id',
        'note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tempatBelajar()
    {
        return $this->belongsTo(TempatBelajar::class, 'tempat_belajar_id');
    }
}