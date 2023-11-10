<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Project extends Model
{
    use HasFactory;

    protected $fillable = ['title','cover_image','description','slug','project_link','online_link'];
    
    public function generateSlug($title)
    {
        return Str::slug($title, '-');
    }

}
