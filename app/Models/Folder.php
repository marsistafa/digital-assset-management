<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Folder extends Model
{
    protected $fillable = ['name', 'parent_id','id_category'];

    // Define the relationship for subfolders
    public function subfolders()
    {
        return $this->hasMany(Folder::class, 'parent_id');
    }
}
