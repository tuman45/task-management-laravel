<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Board extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = ['board_name', 'slug', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function board_lists()
    {
        return $this->hasMany(Board_list::class);
    }

    public function sluggable(): array
    {
        return [
            'board_slug' => [
                'source' => 'board_name'
            ]
        ];
    }
}
