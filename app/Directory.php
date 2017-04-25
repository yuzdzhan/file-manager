<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Directory extends Model
{
    protected $fillable = [
        'name', 'parent_id', 'original_name',
    ];

    public function parent()
    {
        return $this->belongsTo('App\Directory', 'parent_id', 'id');
    }

    public function directories()
    {
        return $this->hasMany('App\Directory', 'parent_id', 'id');
    }
    public function files()
    {
        return $this->hasMany('App\File', 'directory_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'directories_accress_rights', 'directory_id', 'user_id')
            ->withPivot('created_at', 'is_creator')
            ->withTimestamps();
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($directory) {
            $directory->files()->delete();
            $directory->directories()->delete();
        });
    }
}
