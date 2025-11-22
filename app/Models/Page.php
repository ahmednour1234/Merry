<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;

    protected $connection = 'system';
    protected $table = 'pages';

    protected $fillable = ['slug','active','meta'];
    protected $casts = ['active'=>'boolean','meta'=>'array'];

    public function translations()
    {
        return $this->hasMany(PageTranslation::class, 'page_id');
    }
}


