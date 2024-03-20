<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metadata extends Model
{
    use HasFactory;
    protected $fillable = [
        'file_id', 'description', 'keywords', 'expiration_date'
    ];
}
