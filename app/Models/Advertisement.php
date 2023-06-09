<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;
    protected $fillable = ['title',
    'slug',
    'text',
    'phone',
    'domain_id'];
    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}