<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Video;
use App\Models\Tag;
use App\Models\Commentaire;
use App\Models\Image;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
 public function run(): void
{
    // Tags
    $tagLaravel = Tag::create(['libelle' => 'Laravel']);
    $tagPHP     = Tag::create(['libelle' => 'PHP']);
    $tagJS      = Tag::create(['libelle' => 'JavaScript']);
    $tagBDD     = Tag::create(['libelle' => 'Database']);


    //$tags = ['Laravel', 'PHP', 'JavaScript', 'Database'];
    //foreach ($tags as $libelle) {
   //     Tag::create(['libelle' => $libelle]); }

    // Articles
    $article1 = Article::create([
        'title'  => 'Introduction à Laravel',
        'body'   => 'Laravel est un framework PHP moderne qui facilite le développement web.',
        'author' => 'Elix',
    ]);
    $article1->tags()->attach([$tagLaravel->id, $tagPHP->id]);
    $article1->commentaires()->create(['body' => 'Très bon article !', 'author' => 'Visiteur']);
    $article1->images()->create([
        'chemin'      => 'https://picsum.photos/seed/laravel/800/400',
        'description' => 'Laravel banner',
    ]);

    $article2 = Article::create([
        'title'  => 'Les relations Eloquent',
        'body'   => 'Eloquent propose plusieurs types de relations entre modèles.',
        'author' => 'Elix',
    ]);
    $article2->tags()->attach([$tagLaravel->id, $tagBDD->id]);
    $article2->commentaires()->create(['body' => 'Enfin je comprends les relations !', 'author' => 'Visiteur']);
    $article2->images()->create([
        'chemin'      => 'https://picsum.photos/seed/eloquent/800/400',
        'description' => 'Eloquent ORM',
    ]);

    // Videos
    $video1 = Video::create([
        'title'    => 'Laravel Full Course for Beginners',
        'url'      => 'https://www.youtube.com/watch?v=MYyJ4PuL4pY',
        'duration' => 14400,
    ]);
    $video1->tags()->attach([$tagLaravel->id, $tagPHP->id]);
    $video1->commentaires()->create(['body' => 'Meilleur tuto Laravel !', 'author' => 'Visiteur']);
    $video1->images()->create([
        'chemin'      => 'https://img.youtube.com/vi/MYyJ4PuL4pY/maxresdefault.jpg',
        'description' => 'Thumbnail Laravel course',
    ]);

    $video2 = Video::create([
        'title'    => 'JavaScript DOM Crash Course',
        'url'      => 'https://www.youtube.com/watch?v=0ik6X4DJKCc',
        'duration' => 3600,
    ]);
    $video2->tags()->attach([$tagJS->id]);
    $video2->commentaires()->create(['body' => 'Super explication du DOM !', 'author' => 'Visiteur']);
    $video2->images()->create([
        'chemin'      => 'https://img.youtube.com/vi/0ik6X4DJKCc/maxresdefault.jpg',
        'description' => 'Thumbnail JS DOM',
    ]);
}
}
