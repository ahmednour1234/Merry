<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PageTranslation extends Model
{
    use SoftDeletes;

    protected $connection = 'system';
    protected $table = 'page_translations';

    protected $fillable = ['page_id', 'lang_code', 'title', 'content', 'meta_title', 'meta_description'];

    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }
}

