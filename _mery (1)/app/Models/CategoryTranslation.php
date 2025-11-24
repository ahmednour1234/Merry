<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryTranslation extends Model
{
    use SoftDeletes;

    protected $connection = 'system';
    protected $table = 'category_translations';

    protected $fillable = ['category_id','lang_code','name'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
