<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board_list extends Model
{
    use HasFactory;

    protected $fillable = [
        'board_id',
        'user_id',
        'list_name',
        'order',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function board()
    {
        return $this->belongsTo(Board::class);
    }
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
