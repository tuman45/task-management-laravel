<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Carbon\Carbon;

class Task extends Model
{
    use HasFactory;
    use Sluggable;

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'due_date' => 'datetime',
    ];

    public function board()
    {
        return $this->belongsTo(Board::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function board_list()
    {
        return $this->belongsTo(Board_list::class);
    }

    public function getRouteKeyName(): string
    {
        return 'task_slug';
    }

    public function sluggable(): array
    {
        return [
            'task_slug' => [
                'source' => ['user.username', 'task_title']
            ]
        ];
    }

    public function getDueDateAttribute($value)
    {
        return $value ? Carbon::parse($value) : null;
    }
}
