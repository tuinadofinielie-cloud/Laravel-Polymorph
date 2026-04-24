<?php
namespace App\Http\Controllers;
use App\Models\Video;
use Illuminate\Http\Request;
class VideoController extends Controller
{

public function show($id) {
    $item = Video::with(['images', 'tags', 'commentaires'])->findOrFail($id);
    return view('detail', compact('item'));
}


    }

