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
}