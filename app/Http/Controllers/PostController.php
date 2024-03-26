<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Models\Post;


class PostController extends Controller
{
    public function index()
    {
        $post = Post::latest()->get();

        return PostResource::collection($post);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            // 'images' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        $post = Post::create([
            'title' => $request->title,
            'describe' => $request->describe,
            'price' => $request->price,
            'orgprice' => $request->orgprice,
            'day' => $request->day,
            'category' => $request->category,
            'codition' => $request->codition,
            'size' => $request->size,
            'delivery' => $request->delivery,
            'user_id' => auth()->user()->id
        ]);
        
        if ($images = $request->images) {
            foreach ($images as $image) {
                $post->addMedia($image)->toMediaCollection('images');
            }
        }

        return [
            'message' => 'Article created successfully',
            // 'data' => new PostResource($post)
        ];
    }
    public function search(Request $request){
        $post = Post::where('title', 'like', '%'.$request->title.'%')->latest()->get();
        return PostResource::collection($post);
    }
}
