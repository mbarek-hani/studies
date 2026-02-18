<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory;

    protected $fillable = [
        "title",
        "description",
        "start_date",
        "end_date",
        "category",
        "participants_count",
    ];

    public function scopeUpcoming($query)
    {
        return $query->where("start_date", ">=", now());
    }

    public function scopePopular($query)
    {
        return $query->orderByDesc("participants_count");
    }
}
