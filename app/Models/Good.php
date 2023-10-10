<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    use HasFactory;


      protected $fillable = [
        'isLike',
        'task_id',
        'user_id',
    ];

    public function touristSpot()
    {
        return $this->belongsTo(TouristSpot::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
