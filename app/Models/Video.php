<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
  use Illuminate\Database\Eloquent\Concerns\HasUuids;
class Video extends Model
{

        use HasUuids;


    protected $fillable = ['title', 'url', 'duration'];



        public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

      public function commentaires()
    {
        return $this->morphMany(Commentaire::class, 'commentable');
    }

    public function tags() {
    return $this->morphToMany(Tag::class, 'taggable');
}
}
