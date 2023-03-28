<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Revenue extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }

    protected $fillable = [
        'sources',
        'nominal',
        'date',
        'explanation',
        'cat_id',
    ];
}
