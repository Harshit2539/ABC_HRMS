<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
 
class EngageController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        $posts = Post::with(['user', 'reactions', 'comments'])->latest()->get();
        return view('admin.engage.index', compact('posts','comments'));
    }
}
 