<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Post;
use Carbon\Carbon;
 
class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with('user')->latest();
 
        if ($request->month) {
            $month = Carbon::parse($request->month);
            $query->whereYear('created_at', $month->year)->whereMonth('created_at', $month->month);
        }
 
        return response()->json([
            'posts' => $query->get()
        ]);
    }
 
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
        ]);
 
        $post = Post::create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);
 
        return response()->json([
            'status' => 'success',
            'post' => $post,
            'user' => auth()->user(),
        ]);
    }
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
 
        return response()->json(['message' => 'Post deleted successfully']);
    }
    public function fetch()
    {
        $posts = Post::with(['user', 'reactions', 'comments'])->latest()->get();
        return view('posts._post_cards', compact('posts'));
    }
    public function fetchComments(Post $post)
    {
        $comments = $post->comments()->with('user')->latest()->get();
 
        return view('partials.comments', compact('comments'));
    }
    public function show($postId)
    {
        $post = Post::with('comments.user')->findOrFail($postId);
        return view('admin.engage.index', compact('post'));
    }

}