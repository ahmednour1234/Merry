<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    protected $connection = 'system';
    protected $table = 'system_settings';
    
    public $timestamps = true;
    
    protected $fillable = ['scope', 'key', 'value', 'type', 'active'];
    
    protected $casts = [
        'value' => 'array',
        'active' => 'boolean',
    ];
    
    public function getValueAttribute($value)
    {
        if ($this->type === 'json') {
            return json_decode($value, true);
        }
        return $value;
    }
    
    public function setValueAttribute($value)
    {
        if (is_array($value) || is_object($value)) {
            $this->attributes['value'] = json_encode($value, JSON_UNESCAPED_UNICODE);
            $this->attributes['type'] = 'json';
        } else {
            $this->attributes['value'] = (string) $value;
            $this->attributes['type'] = $this->type ?? 'string';
        }
    }
}
