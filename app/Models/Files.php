<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;

class Files extends Model
{
    use HasFactory, HasTags;
    protected $fillable = [
        'path', 'title', 'id_category', 'date_entered', 'id_type', 'file_name'
    ];

    protected $attributes = [
        'path' => 'default_path',
        'title' => 'default_title',
        'id_category' => 0,
        'date_entered' => " ", 
        'id_type' => 1,
        'file_name' => 'default_file_name',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
