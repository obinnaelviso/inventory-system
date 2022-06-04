<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'dept',
        'date',
        'status_id'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function requestItems() {
        return $this->hasMany(RequestItem::class);
    }
}
