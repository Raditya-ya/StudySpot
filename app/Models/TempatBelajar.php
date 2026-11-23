<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempatBelajar extends Model
{
    protected $fillable = [
        'name',
        'location',
        'distance',
        'category',
        'tags',
        'description',
        'address',
        'image_url',
        'status_text',
        'opening_time',
        'closing_time',
        'available_seats',
        'total_seats',
        'noise_level',
        'wifi_speed',
        'rating',
        'total_reviews',
        'facilities',
        'student_note',
        'student_note_author',
        'best_time',
        'price_range',
        'suitable_for',
    ];

    protected $casts = [
        'tags' => 'array',
        'facilities' => 'array',
    ];

    public function studentNotes()
    {
        return $this->hasMany(StudentNote::class, 'tempat_belajar_id')->latest();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'tempat_belajar_id')->latest();
    }
}