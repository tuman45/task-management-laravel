<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

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
}
