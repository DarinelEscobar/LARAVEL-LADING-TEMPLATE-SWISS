<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    protected $table = 'people';
    protected $guarded = ['id'];

    protected $appends = ['full_name'];

    public function setNamesAttribute($value)
    {
        $this->attributes['names'] = ucwords(strtolower($value));
    }

    public function setSurnamesAttribute($value)
    {
        $this->attributes['surnames'] = ucwords(strtolower($value));
    }

    public function getFullNameAttribute(): string
    {
        return trim(sprintf('%s %s', $this->names, $this->surnames));
    }
}
