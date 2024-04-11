<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $fillable = [
        'post_title',
        'post_title',
        'post_text',
        'user_id',
        'type_id'
    ];

    public function likes() : HasMany
    {
        return $this->hasMany(Like::class, 'post_id', 'id' );
    }

}
