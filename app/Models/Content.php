<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    public $fillable = ['name', 'theme', 'type', 'media'];

    public $casts = ['media' => "object"];

    public function contentDetails()
    {
        return $this->hasMany(ContentDetails::class, 'content_id', 'id');
    }

}
