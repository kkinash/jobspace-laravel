<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{

    use HasFactory;
    protected $fillable = ['title', 'company', 'location', 'website', 'email', 'tags', 'description', 'logo', 'user_id'];

    public function scopeFilter($query, array $filters)
    {

        if ($filters['search'] ?? false) {

            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('tags', 'like', '%' . request('search') . '%');
        };
        if ($filters['tag'] ?? false) {

            $query->where('tags', 'like', '%' . request('tag') . '%');
        };
    }

    //user <-> job relationship
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
