<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'item',
        'description',
        'qty',
        'unit',
        'status_id'
    ];

    public function request()
    {
        return $this->belongsTo(Request::class);
    }

    public function status() {
        return $this->belongsTo(Status::class);
    }

    public function getIsCompletedAttribute() {
        return $this->status_id == status_completed_id();
    }

    public function scopePending($query) {
        return $query->where('status_id', status_pending_id());
    }
}
