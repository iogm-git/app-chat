<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $guarded = [''];
    protected $with = ['userId', 'toUser'];
    protected $casts = ['created_at' => 'datetime'];

    public function userId()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }

    public function toUser()
    {
        return $this->hasMany(User::class, 'id', 'to_user');
    }

    public function getCreatedAtAttribute($value)
    {
        // Convert the created_at attribute to the desired format
        return Carbon::parse($value)->format('d M Y H:i');
    }
}
