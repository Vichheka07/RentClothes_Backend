<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class OdersController extends Controller
{

    //seller view customer orders
    public function index(Request $request, $id){
        $post = Post::find($id);
    
        if (!$post) {
            return response(['error' => 'Post not found'], 404);
        }
    
        // Assuming 'orders' is the relationship defined in the Post model
        $postWithOrders = $post->load('orders.user:id,name');
    
        return response([
            'post' => $postWithOrders,
        ], 200);
    }
    
    //customer create orders
    public function store(Request $request){
        $order = new Order;
        $order-> user_id = Auth::user()->id;
        $order-> post_id =$request->id;
        $order-> 
        $order->orderdate = $request->input('orderdate', now());
        $order->save();

        return response()->json([
            'success' => true,
            'messege' => 'order success'
        ]);
    }
    //seller update orders status
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
