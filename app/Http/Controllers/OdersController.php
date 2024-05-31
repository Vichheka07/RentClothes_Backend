<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Post;
use App\Http\Resources\SellerResource;
use Illuminate\Support\Facades\Auth;

class OdersController extends Controller
{

    //seller view customer orders
    public function index(Request $request){
        $post = Post::select('posts.id','posts.title','posts.describe','users.name', 'posts.price', 'posts.day', 'posts.delivery',
        'users.name as user_name', 'orders.size', 'orders.address','orders.orderdate','orders.orderstatus')
        ->join('orders', 'posts.id', '=', 'orders.post_id')
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->where('posts.user_id', Auth::user()->id)
        ->where('orders.orderstatus', 'pending')
        ->get();
    
        if (!$post) {
            return response(['error' => 'Post not found'], 404);
        }
    
        // Assuming 'orders' is the relationship defined in the Post model
        //$postWithOrders = $post->load('orders.user:id,name');
    
        return SellerResource::collection($post);
    }
    //customer view order
    public function show(Request $request){
        $post = Post::select('posts.id','posts.title','posts.describe','posts.price','users.name', 'posts.day', 'posts.delivery',
        'users.name as user_name', 'orders.size','orders.orderdate')
        ->join('orders', 'posts.id', '=', 'orders.post_id')
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->where('orders.user_id', Auth::user()->id)
        ->where('orders.orderstatus', 'pending')
        ->get();
    
        if (!$post) {
            return response(['error' => 'Post not found'], 404);
        }
    
        // Assuming 'orders' is the relationship defined in the Post model
        //$postWithOrders = $post->load('orders.user:id,name');
    
        return SellerResource::collection($post);
    }
    
    //customer create orders
    public function store(Request $request){
        $order = new Order;
        $order-> user_id = Auth::user()->id;
        $order-> post_id =$request->id;
        $order->orderdate = $request->input('orderdate', now());
        $order->address = $request->address;
        $order->size = $request->size;
        $order->save();

        return response()->json([
            'messege' => 'order success'
        ]);
    }
    //seller and customer update orders status
    public function update(Request $request){
        $order = Order::find($request->id);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found',
            ], 404);
        }
        $order->orderstatus = $request->orderstatus;
        $order->save();
    }   
    
}
