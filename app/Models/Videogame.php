<?php

namespace App\Models;

use App\Models\Genre;
use App\Models\Platform;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Videogame extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'title',
        'description',
        'genres_id',
        'platforms_id',
        'price',
    ];

    public function genres()
    {
        return $this->hasMany(Genre::class);
    }

    public function platforms()
    {
        return $this->hasMany(Platform::class);
    }
}
