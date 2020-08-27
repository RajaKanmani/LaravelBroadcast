<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    public $incrementing = false;

    protected $guarded = [];

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($post) {
    //         $post->{$post->getKeyName()} = (string) Str::uuid();
    //     });
    // }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }

    protected $casts = [
        'completed' => 'boolean'
    ];

    public function isComplete($arg)
    {
        return $arg ?? false;
    }
}
