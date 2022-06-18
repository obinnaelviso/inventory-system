<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function status() {
        return $this->belongsTo(Status::class);
    }

    public function getIsCompletedAttribute() {
        return $this->status_id == status_completed_id();
    }
}
