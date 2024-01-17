<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // especifica que campos se quiere ingresar a la dba
    protected $fillable = ['title', 'slug','content','category_id','description','posted','image'];

    // Relacionando para mostrarlo en el index
    public function category(){
        return $this->belongsTo(Category::class);
    }

}
