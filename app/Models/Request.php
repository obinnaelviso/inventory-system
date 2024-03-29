<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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
    public function requestItems()
    {
        return $this->hasMany(RequestItem::class);
    }
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function getIsCompletedAttribute()
    {
        return $this->status_id == status_completed_id();
    }

    // get date
    public function getFmDateAttribute()
    {
        return Carbon::parse($this->date)->format('m-d-Y');
    }
}
