<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Like extends Model
{
    use HasFactory;

    use HasApiTokens, HasFactory, Notifiable;


    protected $table = 'likes';
    protected $fillable = [
        'user_id',
        'post_id'
    ];

    public function post() : BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }

}
