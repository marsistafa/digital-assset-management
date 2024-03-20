<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';

    protected $fillable = [
        'id', 'name', 'description', 'date_created', 'user_id', 'logo_path', 'group_id'
    ];

}
