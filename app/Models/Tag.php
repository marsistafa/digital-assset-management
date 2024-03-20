<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $casts = [];
    public function files()
    {
        return $this->belongsToMany(File::class);
    }
}
