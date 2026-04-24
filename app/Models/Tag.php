<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
class Tag extends Model
{
    use HasUuids;
    protected $fillable = ['libelle'];

    public function articles() {
    return $this->morphedByMany(Article::class, 'taggable');
}

    public function videos() {
    return $this->morphedByMany(Video::class, 'taggable');
}
}
