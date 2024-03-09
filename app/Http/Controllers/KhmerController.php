<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Models\Post;

class KhmerController extends Controller{
    public function index(Request $request,$category)
{
    // Assuming 'category' is the column in your Post model
    // $category = $request->input('category'); 

    $post = Post::where('category', $category)->latest()->get();

    if ($post->isEmpty()) {
        return response(['error' => 'Post not found'], 404);
    }

    // Assuming 'orders' is the relationship defined in the Post model
    // $postWithOrders = $post->load('orders.user:id,name');

    return PostResource::collection($post);
}

}