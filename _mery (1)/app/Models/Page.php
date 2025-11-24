<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;

    protected $connection = 'system';
    protected $fillable = ['title', 'slug', 'content', 'meta_title', 'meta_description', 'active'];
    protected $casts = ['active' => 'boolean'];

    public function translations()
    {
        return $this->hasMany(PageTranslation::class, 'page_id');
    }
}

