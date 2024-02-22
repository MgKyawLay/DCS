<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Campaign extends Model
{
    use HasFactory, AsSource, Attachable, Filterable;

    protected $fillable = [
        'name',
        'category',
        'contact',
        'description',
        'goal_amount',
        'raise_amount',
        'start_date',
        'end_date',
        'media'
    ];
}
